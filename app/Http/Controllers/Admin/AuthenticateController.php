<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Api\ApiResponse;
use App\Helpers\Auth\AuthenticateUtils;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminMessage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{
    use  AuthenticateUtils, AuthenticatesUsers, ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout']);
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
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
            $account => 'required|exists:admins',
            'password' => 'required|between:6,16',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        //账号密码校验
        if (!$this->attemptLogin($request)) {
            return $this->failed($this->account($request) . ' or password is invalid');
        }

        //账号信息存储到 session
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->success();
    }

    /**
     * 账号密码校验
     *
     * @param Request $request
     * @return mixed
     * @throws \App\Helpers\Api\ApiException
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::guard('admin')->attempt($this->credentials($request));
    }

    /**
     * 退出登录, 清除 session
     *
     * @param Request $request
     * @return $this
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('/admin/login');
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return $this
     * @throws \App\Helpers\Api\ApiException
     */
    public function reset_password(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->account($request);
        //字段合法校验
        $validator = Validator::make($request->all(), [
            $account => 'required|exists:admins',
            'password' => 'required|between:6,16'
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }
        //校验验证码
        $this->check_verify_code($request);
        //更新该账号密码
        Admin::where($account, $request->post('account'))
            ->update([
                'password' => bcrypt($request->post('password'))
            ]);
        //生成token
        return $this->login($request);
    }

    /**
     * 过滤获取校验身份字段: phone, password
     *
     * @param Request $request
     * @return array
     * @throws \App\Helpers\Api\ApiException
     */
    public function credentials(Request $request)
    {
        return $request->only([$this->account($request), 'password']);
    }

    /**
     * 设置后台管理账号
     */
    public function set_admin()
    {

        Admin::truncate();
        AdminMessage::truncate();

        $admin = Admin::create([
            'phone' => env('ADMIN_PHONE'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD'))
        ]);

        AdminMessage::create([
            'user_name' => env('ADMIN_NAME'),
            'user_id' => $admin->id
        ]);

        echo "OK";
    }

}