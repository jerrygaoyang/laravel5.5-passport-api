<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/26
 * Time: 11:51
 */

namespace App\Helpers\Iot\Request;

class IotRequest
{
    public static $domain = 'https://iot.cn-shanghai.aliyuncs.com/';

    public static function combine($request)
    {
        /**
         * 通用参数设置
         */
        $request->setFormat('JSON');
        $request->setRegionId('cn-hangzhou');
        $request->setVersion('2017-04-20');
        $request->setSignatureNonce(md5(uniqid(mt_rand(), true)));
        $request->setSignatureMethod('HMAC-SHA1');
        $request->setSignatureVersion('1.0');
        $request->setTimestamp(gmdate('Y-m-d\TH:i:s\Z'));

        /**
         * 密钥设置
         */
        $request->setAccessKeyId(config('ali.AccessKeyId'));
        $request->setAccessKeySecret(config('ali.AccessKeySecret'));

        return $request;
    }
}