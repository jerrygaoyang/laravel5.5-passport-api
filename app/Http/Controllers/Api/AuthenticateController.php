<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Helpers\Auth\AuthenticateUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Api\ApiException;
use App\Models\User;
use App\Models\UserMessage;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client as HttpClient;
use Laravel\Passport\Client as OauthClient;

class AuthenticateController extends Controller
{
    use  AuthenticatesUsers, AuthenticateUtils, ApiResponse;

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
        $account = $this->account($request);

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
            return $this->failed($this->account($request) . ' or password is invalid');
        }
        //密码授权获取Token
        return $this->success($this->password_token($request));
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
     * @return AuthenticateController
     * @throws \App\Helpers\Api\ApiException
     */
    public function register(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->account($request);
        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|unique:users',
            'password' => 'required|between:6,16'
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }
        //校验验证码
        $this->check_verify_code($request);
        //同步数据库添加用户
        $this->create_user($request);
        //生成token
        return $this->login($request);
    }

    /**
     * 添加用户信息到 users 和 user_message 表
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public function create_user(Request $request)
    {
        //存储users表
        $data = $request->only(['password', $this->account($request)]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        //同步用户信息到user_message
        $user_name = $request->post($this->account($request));
        if ($request->has('user_name')) {
            $user_name = $request->post('user_name');
        }
        $data = [
            'user_name' => $user_name,
            'user_id' => $user->id
        ];
        UserMessage::create($data);
        return $user;
    }

    /**
     * 根据账号和验证码快捷登陆
     *
     * 待完善...
     *
     * @param Request $request
     * @return AuthenticateController
     * @throws ApiException
     */
    public function fast_login(Request $request)
    {
        //校验验证码
        $this->check_verify_code($request);
        //判断该用户是否已注册, 未注册则添加用户
        $user = User::where($this->account($request), $request->post($this->account($request)))->first();
        if (!$user) {
            $user = $this->create_user($request);
        }
        //分配个人令牌
        $token = $this->personal_token($user);
        $token['refresh_token'] = '';
        return $this->success($token);
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
        $account = $this->account($request);
        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|exists:users',
            'password' => 'required|between:6,16'
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }
        //校验验证码
        $this->check_verify_code($request);
        //更新该账号密码
        User::where($account, $request->post('account'))
            ->update([
                'password' => bcrypt($request->post('password'))
            ]);
        //生成token
        return $this->login($request);
    }

    /**
     * 账号密码校验
     *
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::guard()->attempt($this->credentials($request));
    }

    /**
     * passport password token 中 client id 和 secret 设置
     *
     * @return array
     * @throws ApiException
     */
    public function password_client()
    {
        $oauth_client = OauthClient::query()
            ->where('password_client', 1)
            ->orderByDesc('id')
            ->first();
        if (!$oauth_client) {
            throw new ApiException('服务器缺少oauth_client');
        }
        return [
            'client_id' => $oauth_client->id,
            'client_secret' => $oauth_client->secret
        ];
    }

    /**
     * passport personal token 中 client id 和 secret 设置
     *
     * @return array
     * @throws ApiException
     */
    public function personal_client()
    {
        $oauth_client = OauthClient::query()
            ->where('personal_access_client', 1)
            ->orderByDesc('id')
            ->first();
        if (!$oauth_client) {
            throw new ApiException('服务器缺少oauth_client');
        }
        return [
            'client_id' => $oauth_client->id,
            'client_secret' => $oauth_client->secret
        ];
    }

    /**
     * 个人授权获取 token
     *
     * @param $user
     * @return mixed
     * @throws ApiException
     */
    public function personal_token($user)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'personal_access',
                    'client_id' => $this->personal_client()['client_id'],
                    'client_secret' => $this->personal_client()['client_secret'],
                    'user_id' => $user->id,
                    'scope' => '',
                ]
            ]);
            return json_decode($res->getBody(), true);
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
    }


    /**
     * 密码授权获取token
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public function password_token(Request $request)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'password',
                    'client_id' => $this->password_client()['client_id'],
                    'client_secret' => $this->password_client()['client_secret'],
                    'username' => $request->post('account'),
                    'password' => $request->post('password'),
                    'scope' => ''
                ]
            ]);
            return json_decode($res->getBody(), true);
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
    }

    /**
     * 刷新token
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public function refresh_token(Request $request)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => $this->password_client()['client_id'],
                    'client_secret' => $this->password_client()['client_secret'],
                    'refresh_token' => $request->post('refresh_token'),
                    'scope' => ''
                ]
            ]);
            return $this->success(json_decode($res->getBody(), true));
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
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
        return $request->only([$this->account($request), 'password']);
    }

}