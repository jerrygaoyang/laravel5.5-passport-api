<?php

namespace App\Helpers\Auth;

use App\Helpers\Api\ApiException;
use App\Models\VerifyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait AuthenticateUtils
{
    public function account(Request $request)
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
     * 校验验证码
     *
     * @param Request $request
     * @throws ApiException
     */
    public function check_verify_code(Request $request)
    {
        //获取校验账号对应参数
        $account = $this->account($request);

        if (!$request->has('code')) {
            throw new ApiException('lack param code');
        }
        $code = $request->post('code');

        //获取该账号数据库存储的验证码
        $verify_code = VerifyCode::where('account', $request->post($account))
            ->where('code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->where('revoked', '!=', 1)
            ->first();
        if (!$verify_code) {
            throw new ApiException('invalid code');
        }

        /**
         * 若需求要求验证码一次有效,直接将下面代码注释一处即可
         */
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
        $account = $this->account($request);

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