<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/26
 * Time: 14:45
 */

namespace App\Helpers\Iot;

use App\Helpers\Iot\Request\IotRequest;
use Codeforyou\ali\Core\AliRequest;
use Codeforyou\ali\Iot\PubTopicRequest;

class PubToTopic
{
    public static function execute($ProductKey, $MessageContent, $DeviceName)
    {
        $request = IotRequest::combine(new PubTopicRequest());

        /**
         * 创建产品参数设置
         */
        $topic = "/" . $ProductKey . "/" . $DeviceName . "/get";
        $request->setAction('Pub');
        $request->setProductKey($ProductKey);
        $request->setTopicFullName($topic);
        $request->setMessageContent(base64_encode($MessageContent));
        $request->setQos(0);

        /**
         * 回调处理
         */
        $res = AliRequest::commit(IotRequest::$domain, $request);
        return json_decode($res, true);
    }
}