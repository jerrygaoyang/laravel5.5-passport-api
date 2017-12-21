<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'Api', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthenticateController@login');
    Route::post('logout', 'AuthenticateController@logout');
    Route::post('register', 'AuthenticateController@register');
    Route::post('verify_code', 'AuthenticateController@verify_code');
    Route::post('refresh_token', 'AuthenticateController@refresh_token');
    Route::post('reset_password', 'AuthenticateController@reset_password');
});
