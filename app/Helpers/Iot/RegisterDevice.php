<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/26
 * Time: 14:49
 */

namespace App\Helpers\Iot;

use App\Helpers\Iot\Request\IotRequest;
use Codeforyou\ali\Core\AliRequest;
use Codeforyou\ali\Iot\RegisterDeviceRequest;

class RegisterDevice
{
    public static function execute($ProductKey, $DeviceName)
    {
        $request = IotRequest::combine(new RegisterDeviceRequest());

        /**
         * 注册设备参数设置
         */
        $request->setAction('RegistDevice');
        $request->setProductKey($ProductKey);
        $request->setDeviceName($DeviceName);

        /**
         * 回调处理
         */
        $res = AliRequest::commit(IotRequest::$domain, $request);
        return json_decode($res, true);
    }
}