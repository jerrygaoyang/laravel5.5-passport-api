<?php

namespace App\Http\Controllers\Device;

use App\Helpers\Mns\BatchDeleteMessage;
use App\Helpers\Mns\BatchReceiveMessage;
use App\Models\MnsData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class BatchReceiveMessageController extends Controller
{
    public function index()
    {
        $res = BatchReceiveMessage::execute('aliyun-iot-NGwj3AALJOF');
        if ($res) {
            $messages = $res->getMessages();
            $receiptHandles = [];
            foreach ($messages as $message) {
                $receiptHandle = $message->getReceiptHandle();
                $receiptHandles[] = $receiptHandle;
                $body = $message->getMessageBody();
                $this->sync_data($body);
            }
            BatchDeleteMessage::execute('aliyun-iot-NGwj3AALJOF', $receiptHandles);
        }
    }

    public function sync_data($body)
    {

        Log::info($body);

        $data = json_decode($body, true);
        if ($data && in_array('device_id', $data) && in_array('device_data', $data)) {
            $device_id = $data['device_id'];
            $device_data = $data['device_data'];
            MnsData::create(['device_id' => $device_id, 'device_data' => $device_data]);
        }
    }
}
