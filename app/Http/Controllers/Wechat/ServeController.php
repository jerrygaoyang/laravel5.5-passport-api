<?php

namespace App\Http\Controllers\Wechat;

use App\Models\IotDevice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Helpers\Wechat\Wechat;

class ServeController extends Controller
{
    public function index()
    {
        Wechat::app()->server->push(function ($message) {

            Log::info($message);

            $res = $this->bind($message);
            if ($res) {
                return $res;
            } else {
                $res = $this->unbind($message);
                if ($res) {
                    return '你操作了我！';
                } else {
                    return '你操作了我！';
                }
            }

        });

        return Wechat::app()->server->serve();
    }

    public function bind($message)
    {
        if (is_array($message) && in_array('msg_type', $message) && $message['msg_type'] == 'bind') {
            $device_id = $message['device_id'];
            $open_id = $message['open_id'];
            IotDevice::where('device_name', $device_id)->update(['open_id' => $open_id]);
            return '设备绑定成功';
        }
        return false;
    }

    public function unbind($message)
    {
        if (is_array($message) && in_array('msg_type', $message) && $message['msg_type'] == 'unbind') {
            $device_id = $message['device_id'];
            $open_id = $message['open_id'];
            IotDevice::where('device_name', $device_id)
                ->where('open_id', $open_id)
                ->delete();
            return '设备解绑成功';
        }
        return false;
    }
}
