<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});

/**
 * 微信
 */


Route::group(['namespace' => 'Wechat'], function () {
    Route::any('wechat', 'ServeController@index');
});


/**
 * 后台管理账号重置
 */
Route::get('set_admin', 'Admin\AuthenticateController@set_admin');


/**
 * 后台管理
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    /**
     * Auth认证
     */
    Route::get('login', 'AuthenticateController@showLoginForm');
    Route::post('login', 'AuthenticateController@login');
    Route::get('logout', 'AuthenticateController@logout');
    Route::post('verify_code', 'AuthenticateController@verify_code');
    Route::post('reset_password', 'AuthenticateController@reset_password');

    /**
     * 后台管理内容界面操作
     */
    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/', 'IndexController@index');

        /**
         * IOT套件后台管理界面操作
         */
        Route::group(['namespace' => 'Iot', 'prefix' => 'iot'], function () {
            Route::resource('product', 'ProductController');
            Route::resource('device', 'DeviceController');
        });

        /**
         *  房屋管理界面操作
         */
        Route::group(['namespace' => 'house', 'prefix' => 'house'], function () {
            Route::resource('area', 'HouseAreaController');
            Route::resource('info', 'HouseInfoController');
            Route::resource('open', 'HouseOpenController');
        });

        /**
         *  用户管理界面操作
         */
        Route::group(['namespace' => 'user', 'prefix' => 'user'], function () {
            Route::resource('info', 'UserInfoController');
        });
    });

});


/**
 * 给予硬件设备端提供的接口
 */
Route::resource('device', 'Device\DeviceController');


Route::get('test', function () {
    \App\Models\HouseInfo::create([
        'house_acreage' => '100',
        'house_address' => '上海-xxx-xxx-xxx',
        'rent_price' => '10000',
        'house_date_start' => '2018-1-1',
        'house_date_end' => '2019-1-1',
        'house_decoration' => 'WIFI',
        'is_rent' => false
    ]);
});





