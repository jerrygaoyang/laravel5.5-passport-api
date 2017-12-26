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
use Codeforyou\ali\Iot\CreateProductRequest;

class CreateProduct
{
    public static function execute($Name, $Desc)
    {
        $request = IotRequest::combine(new CreateProductRequest());

        /**
         * 创建产品参数设置
         */
        $request->setAction('CreateProduct');
        $request->setName($Name);
        $request->setDesc($Desc);

        /**
         * 回调处理
         */
        $res = AliRequest::commit(IotRequest::$domain, $request);
        return json_decode($res, true);
    }
}