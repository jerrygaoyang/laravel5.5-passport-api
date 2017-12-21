<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiException;
use App\Helpers\Api\ApiResponse;
use App\Models\User;
use App\Models\UserMessage;
use App\Models\VerifyCode;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{
    use AuthenticatesUsers, ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout']);
    }

    /**
     * 根据手机号和密码获取Token
     *
     * @param Request $request
     * @return $this
     * @throws \App\Helpers\Api\ApiException
     */
    public function login(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->username($request);

        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|exists:users',
            'password' => 'required|between:6,16',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        //账号密码校验
        if (!$this->attemptLogin($request)) {
            return $this->failed($this->username($request) . ' or password is invalid');
        }

        //密码授权获取Token
        return $this->success(User::access_token($request));
    }

    /**
     * 过滤获取校验身份字段: phone, password
     *
     * @param Request $request
     * @return array
     * @throws ApiException
     */
    public function credentials(Request $request)
    {
        return $request->only([$this->username($request), 'password']);
    }

    /**
     * 账号密码校验
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::guard()->attempt($this->credentials($request));
    }

    /**
     * 账号校验字段设置
     *
     * @param Request $request
     * @return string
     * @throws ApiException
     */
    public function username(Request $request)
    {
        //校验请求参数是否包含account
        if (!$request->has('account')) {
            throw new ApiException('lack param account');
        }
        $account = $request->post('account');

        //手机/邮箱正则表达式
        $phone_pattern = '/^1[0-9]{10}$/';
        $email_pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/';

        //校验account为手机/邮箱
        if (preg_match($phone_pattern, $account)) {
            //并将phone添加到request参数中,并返回校验账号对应参数
            $request->request->add(['phone' => $account]);
            return 'phone';
        } else if (preg_match($email_pattern, $account)) {
            //并将email添加到request参数中,并返回校验账号对应参数
            $request->request->add(['email' => $account]);
            return 'email';
        } else {
            throw new ApiException('the account param is not phone or email');
        }
    }

    /**
     * 退出登录, token设为失效
     *
     * @return $this
     */
    public function logout()
    {
        Auth::guard('api')->user()->token()->revoke();
        return $this->success();
    }

    /**
     * 注册校验,并生成token
     *
     * @param Request $request
     * @return $this|AuthenticateController
     * @throws \App\Helpers\Api\ApiException
     */
    public function register(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->username($request);

        //获取该账号数据库存储的验证码对象
        $verify_code = $this->get_verify_code($request);

        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|unique:users',
            'password' => 'required|between:6,16',
            'code' => 'required|in:' . $verify_code->code
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        //将验证码更新为无效
        $this->revoke_verify_code($verify_code);

        //存储users表
        $data = $request->only(['password', $this->username($request)]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        //同步用户信息到user_message
        $user_name = $request->post($this->username($request));
        if ($request->has('user_name')) {
            $user_name = $request->post('user_name');
        }
        $data = [
            'user_name' => $user_name,
            'user_id' => $user->id
        ];
        UserMessage::create($data);

        //生成token
        return $this->login($request);
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return $this
     * @throws ApiException
     */
    public function reset_password(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->username($request);

        //获取该账号数据库存储的验证码对象
        $verify_code = $this->get_verify_code($request);

        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|exists:users',
            'password' => 'required|between:6,16',
            'code' => 'required|in:' . $verify_code->code
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        //将验证码更新为无效
        $this->revoke_verify_code($verify_code);

        //更新该账号密码
        User::where($account, $request->post('account'))
            ->update([
                'password' => bcrypt($request->post('password'))
            ]);

        //生成token
        return $this->login($request);
    }

    /**
     * 从数据库获取验证码，返回验证码对象
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public function get_verify_code(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->username($request);

        //获取该账号数据库存储的验证码
        $verify_code = VerifyCode::where('account', $request->post($account))
            ->where('expires_at', '>', Carbon::now())
            ->where('revoked', '!=', 1)
            ->first();
        if (!$verify_code) {
            throw new ApiException('invalid code');
        }
        return $verify_code;
    }

    /**
     * 废弃已使用的验证码
     *
     * @param $verify_code
     */
    public function revoke_verify_code($verify_code)
    {
        $verify_code->revoked = 1;
        $verify_code->save();
    }

    /**
     * 手机或邮件发送验证码
     *
     * @param Request $request
     * @return $this
     * @throws ApiException
     */
    public function verify_code(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->username($request);

        /**
         * 生成验证码
         * $code = rand(100000, 999999);
         *
         * 当前 $code = 1234, 用于测试
         */
        $code = 1234;

        //根据账号类型来发送验证码到手机短信或邮件
        if ($account == 'phone') {
            /**
             * 发送手机短信验证码
             *
             * 此处添加自己调取自己的短信发送接口
             * 根据发送回调判断是否发送成功
             */
            $callback = 1;
            if (!$callback) {
                throw new ApiException('发送失败');
            }
        } else {
            /**
             * 发送邮件验证码
             *
             * 此处添加自己调取自己的邮件发送接口
             * 根据发送回调判断是否发送成功
             */
            $callback = 1;
            if (!$callback) {
                throw new ApiException('发送失败');
            }
        }

        //将验证码存储到verify_code表, 验证码有效期15分钟
        $data = [
            'code' => $code,
            'account' => $request->post($account),
            'category' => $account,
            'expires_at' => Carbon::now()->addMinutes(15)
        ];
        VerifyCode::create($data);

        return $this->success();
    }
}
