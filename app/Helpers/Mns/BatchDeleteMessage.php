<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2018/1/3
 * Time: 13:05
 */

namespace App\Helpers\Mns;


use Codeforyou\ali\Mns\Client;
use Codeforyou\ali\Mns\Exception\MnsException;

class BatchDeleteMessage
{
    public static function execute($queueName, $receiptHandles)
    {
        $endPoint = 'http://35271263.mns.cn-shanghai.aliyuncs.com/';
        $accessId = config('ali.AccessKeyId');
        $accessKey = config('ali.AccessKeySecret');
        $client = new Client($endPoint, $accessId, $accessKey);
        $queue = $client->getQueueRef($queueName);
        try {
            $res = $queue->batchDeleteMessage($receiptHandles);
            return $res;
        } catch (MnsException $e) {
            return $e->getMessage();
        }
    }
}