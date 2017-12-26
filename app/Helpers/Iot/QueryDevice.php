<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/26
 * Time: 14:50
 */

namespace App\Helpers\Iot;

use App\Helpers\Iot\Request\IotRequest;
use Codeforyou\ali\Core\AliRequest;
use Codeforyou\ali\Iot\QueryDeviceRequest;

class QueryDevice
{
    public static function execute($ProductKey, $PageSize, $CurrentPage)
    {
        $request = IotRequest::combine(new QueryDeviceRequest());

        /**
         * 查询设备信息列表参数设置
         */
        $request->setAction('QueryDevice');
        $request->setProductKey($ProductKey);
        $request->setPageSize($PageSize);
        $request->setCurrentPage($CurrentPage);

        /**
         * 回调处理
         */
        $res = AliRequest::commit(IotRequest::$domain, $request);
        return json_decode($res, true);
    }

}