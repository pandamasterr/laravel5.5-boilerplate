<?php

use Illuminate\Http\Request;

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



Route::get('/test/index', 'TestController@index');

/**
 * 用户端 注册登录地址
 */
Route::namespace('Auth')->prefix('/v1')->group(function () {
    Route::namespace('TakeOut')->group(function () {
        Route::post('auth/register', 'RegisterController@register');
        Route::post('auth/login', 'LoginController@login');
        Route::post('auth/refresh/token', 'LoginController@refreshToken');
    });
});
/**
 * 后台管理人员的登录
 */
Route::namespace('Auth')->prefix('/v1')->group(function () {
    Route::namespace('Manager')->group(function () {
        Route::post('gm/login', 'LoginController@login');
        Route::post('gm/refresh/token', 'LoginController@refreshToken');
    });
});

Route::namespace('V1')->prefix('/v1')->middleware([ 'auth-frontend' ])->group(function() {


    Route::namespace('Frontend')->group(function () {
        Route::get('member', 'MemberController@show');
        Route::put('members/{id}', 'MemberController@update');
    });



});
