<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/26
 * Time: 14:47
 */

namespace App\Helpers\Iot;

use App\Helpers\Iot\Request\IotRequest;
use Codeforyou\ali\Core\AliRequest;
use Codeforyou\ali\Iot\UpdateProductRequest;

class UpdateProduct
{
    public static function execute($ProductKey, $ProductName, $ProductDesc)
    {
        $request = IotRequest::combine(new UpdateProductRequest());

        /**
         * 编辑产品参数设置
         */
        $request->setAction('UpdateProduct');
        $request->setProductKey($ProductKey);
        $request->setProductName($ProductName);
        $request->setProductDesc($ProductDesc);

        /**
         * 回调处理
         */
        $res = AliRequest::commit(IotRequest::$domain, $request);
        return json_decode($res, true);
    }
}