<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api\ApiResponse;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //字段合法校验
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|exists:users',
            'password' => 'required|between:6,16',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        //账号密码校验
        if (!$this->attemptLogin($request)) {
            return $this->failed($this->username() . ' or password is invalid');
        }

        //密码授权获取Token
        return $this->success(User::access_token($request));
    }

    /**
     * 过滤获取校验身份字段: phone, password
     *
     * @param Request $request
     * @return array
     */
    public function credentials(Request $request)
    {
        return $request->only([$this->username(), 'password']);
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
     * 账号校验字段设置
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
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
        //字段合法校验
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|exists:users',
            'password' => 'required|between:6,16'
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->errors());
        }

        $data = $request->only(['name', 'password', $this->username()]);
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return $this->login($request);
    }
}
