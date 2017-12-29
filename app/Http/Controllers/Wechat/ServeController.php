<?php

namespace App\Http\Controllers\Wechat;

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
            return "欢迎关注 高杨！";

        });

        return Wechat::app()->server->serve();
    }
}
