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
     * passport token 校验账号根据手机或邮箱字段校验
     *
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        return $this->where('phone', $username)->orWhere('email', $username)->first();
    }

    /**
     * passport password token 中 client id 和 secret 设置
     *
     * @return array
     * @throws ApiException
     */
    public static function password_client()
    {
        $oauth_client = OauthClient::query()
            ->where('password_client', 1)
            ->orderByDesc('id')
            ->first();
        if (!$oauth_client) {
            throw new ApiException('服务器缺少oauth_client');
        }
        return [
            'client_id' => $oauth_client->id,
            'client_secret' => $oauth_client->secret
        ];
    }

    /**
     * passport personal token 中 client id 和 secret 设置
     *
     * @return array
     * @throws ApiException
     */
    public static function personal_client()
    {
        $oauth_client = OauthClient::query()
            ->where('personal_access_client', 1)
            ->orderByDesc('id')
            ->first();
        if (!$oauth_client) {
            throw new ApiException('服务器缺少oauth_client');
        }
        return [
            'client_id' => $oauth_client->id,
            'client_secret' => $oauth_client->secret
        ];
    }

    /**
     * 个人授权获取 token
     *
     * @param $user
     * @return mixed
     * @throws ApiException
     */
    public static function personal_token($user)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'personal_access',
                    'client_id' => self::personal_client()['client_id'],
                    'client_secret' => self::personal_client()['client_secret'],
                    'user_id' => $user->id,
                    'scope' => '',
                ]
            ]);
            return json_decode($res->getBody(), true);
        } catch (ClientException $e) {
            throw new ApiException($e->getMessage());
        }
    }


    /**
     * 密码授权获取token
     *
     * @param Request $request
     * @return mixed
     * @throws ApiException
     */
    public static function password_token(Request $request)
    {
        $http = new HttpClient();
        try {
            $res = $http->post(env('APP_URL') . '/oauth/token', [
                'json' => [
                    'grant_type' => 'password',
                    'client_id' => self::password_client()['client_id'],
                    'client_secret' => self::password_client()['client_secret'],
                    'username' => $request->post('account'),
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
                    'client_id' => self::password_client()['client_id'],
                    'client_secret' => self::password_client()['client_secret'],
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
