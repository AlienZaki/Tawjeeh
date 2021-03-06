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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::post('test', 'Api\AuthController@test');
    Route::post('login', 'Api\AuthController@login');
    Route::post('user/create', 'Api\AuthController@signup');


    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('getUser', 'Api\AuthController@getUser');
    });
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('client/create', 'ClientController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('client/{qrCode}', 'ClientController@getClient');
    });
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('client/{qrCode}/confirm', 'ClientController@flagStage');
    });


});

