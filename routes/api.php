<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login','AuthController@login');
    Route::post('signup','AuthController@register');
    Route::post('forget_password','AuthController@forget_password');
    Route::post('check_reset_code','AuthController@check_reset_code');
    Route::post('reset_password','AuthController@reset_password');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('me','AuthController@show');
        Route::post('refresh','AuthController@refresh');
        Route::post('update','AuthController@update');
        Route::get('resend_verify', 'AuthController@resend_verify');
        Route::post('verify', 'AuthController@verify');
        Route::post('change_password','AuthController@change_password');
        Route::post('logout','AuthController@logout');
    });
});
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::group([
        'prefix' => 'notifications',
    ], function() {
        Route::get('/', 'NotificationController@index');
        Route::post('send', 'NotificationController@send');
        Route::post('read', 'NotificationController@read');
        Route::post('read/all', 'NotificationController@read_all');
    });

    Route::group([
        'prefix' => 'transactions',
    ], function() {
        Route::get('/', 'TransactionController@index');
        Route::get('my_balance', 'TransactionController@my_balance');
        Route::post('generate_checkout', 'TransactionController@generate_checkout');
        Route::get('check_payment', 'TransactionController@check_payment');
        Route::post('request_refund', 'TransactionController@request_refund');
    });
    Route::group([
        'prefix' => 'tickets',
    ], function() {
        Route::get('/','TicketController@index');
        Route::get('show','TicketController@show');
        Route::post('store','TicketController@store');
        Route::post('response','TicketController@response');
    });
    Route::group([
        'prefix' => 'foods',
    ], function() {
        Route::get('/','FoodController@index');
        Route::get('show','FoodController@show');
        Route::post('store','FoodController@store');
        Route::post('update','FoodController@update');
        Route::post('destroy','FoodController@destroy');
        Route::post('media/destroy','FoodController@destroy_media');
    });
    Route::group([
        'prefix' => 'coupons',
    ], function() {
        Route::get('/','CouponController@index');
        Route::get('show','CouponController@show');
        Route::post('store','CouponController@store');
        Route::post('update','CouponController@update');
        Route::post('destroy','CouponController@destroy');
    });
    Route::group([
        'prefix' => 'orders',
    ], function() {
        Route::get('/','OrderController@index');
        Route::get('show','OrderController@show');
        Route::post('store','OrderController@store');
        Route::post('update','OrderController@update');
        Route::get('check_coupon','OrderController@check_coupon');
    });
});

Route::group([
    'prefix' => 'home',
], function() {
    Route::get('install','HomeController@install');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('providers','HomeController@providers');
        Route::post('subscribe','HomeController@subscribe');
        Route::post('send_notification','HomeController@send_notification');
        Route::get('favourites','HomeController@favourites');
        Route::post('favourite_toggle','HomeController@favourite_toggle');

    });
});

