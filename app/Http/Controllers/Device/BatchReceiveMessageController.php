<?php

namespace App\Http\Controllers\Device;

use App\Helpers\Mns\BatchDeleteMessage;
use App\Helpers\Mns\BatchReceiveMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatchReceiveMessageController extends Controller
{
    public function sync_data()
    {
        $res = BatchReceiveMessage::execute('aliyun-iot-NGwj3AALJOF');
        if ($res) {
            $messages = $res->getMessages();
            $receiptHandles = [];
            foreach ($messages as $message) {
                $body = $message->getMessageBody();
                $receiptHandle = $message->getReceiptHandle();

                $receiptHandles[] = $receiptHandle;
            }
            BatchDeleteMessage::execute('aliyun-iot-NGwj3AALJOF', $receiptHandles);
        }
    }
}
