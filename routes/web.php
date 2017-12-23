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


Route::get('set_admin', 'Admin\AuthenticateController@set_admin');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('login', 'AuthenticateController@showLoginForm');
    Route::post('login', 'AuthenticateController@login');
    Route::get('logout', 'AuthenticateController@logout');
    Route::post('verify_code', 'AuthenticateController@verify_code');
    Route::post('reset_password', 'AuthenticateController@reset_password');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', 'IndexController@index');
    });

});
