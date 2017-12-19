<?php

namespace App\Models;

use App\Helpers\Api\ApiException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use GuzzleHttp\Client as HttpClient;
use Laravel\Passport\Client as OauthClient;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];


    /**
     * passport token 校验账号根据手机字段校验
     *
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        return $this->where('phone', $username)->first();
    }


    /**
     * passport token 中 client id 和 secret 设置
     *
     * @return array
     */
    public static function oauth_client()
    {
        $oauth_client = OauthClient::query()->orderByDesc('id')->first();
        return [
            'client_id' => $oauth_client->id,
            'client_secret' => $oauth_client->secret
        ];
    }


    /**
     * 密码授权获取token
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public static function access_token(Request $request)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'password',
                    'client_id' => self::oauth_client()['client_id'],
                    'client_secret' => self::oauth_client()['client_secret'],
                    'username' => $request->post('phone'),
                    'password' => $request->post('password'),
                    'scope' => ''
                ]
            ]);
            return json_decode($res->getBody(), true);
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
    }

    /**
     * 刷新token
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public static function refresh_token(Request $request)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'refresh_token',
                    'client_id' => self::oauth_client()['client_id'],
                    'client_secret' => self::oauth_client()['client_secret'],
                    'refresh_token' => $request->post('refresh_token'),
                    'scope' => ''
                ]
            ]);
            return json_decode($res->getBody(), true);
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
    }


}
