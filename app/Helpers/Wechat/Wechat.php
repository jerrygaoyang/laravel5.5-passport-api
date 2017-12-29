<?php
/**
 * Created by PhpStorm.
 * User: gaoyang
 * Date: 2017/12/29
 * Time: 9:56
 */

namespace App\Helpers\Wechat;

use GuzzleHttp\Client;


class Wechat
{
    /**
     * 微信应用 app 实例
     * @return \Illuminate\Foundation\Application|mixed
     */
    public static function app()
    {
        return app('wechat.official_account');
    }

    /**
     * 微信注册设备
     * @return \Psr\Http\Message\StreamInterface
     */
    public static function RegisterDevice()
    {
        $access_token = self::app()->access_token->getToken();
        $product_id = config('wechat.product.product_id');
        $client = new Client();
        $data = [
            'access_token' => $access_token,
            'product_id' => $product_id
        ];
        $query_params = http_build_query($data);
        $url = 'https://api.weixin.qq.com/device/getqrcode?' . $query_params;
        $res = $client->get($url);

        return $res->getBody();
    }
}