<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test','TestController@test');

Route::prefix('user')->group(function(){
    Route::post('register','UserController@register');
    Route::post('login','UserController@login');
});
Route::middleware(['api-token-auth'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::post('info','UserController@info');
        Route::post('query','UserController@query');
        Route::post('bindPhone','UserController@bindPhone');
        Route::post('editHeadPortrait','UserController@editHeadPortrait');
    });

    Route::prefix('firend')->group(function () {
        Route::post('add','FirendsController@add');
        Route::post('agree','FirendsController@agree');
        Route::post('refuse','FirendsController@refuse');
        Route::post('applyList','FirendsController@applyList');
    });

    Route::prefix('im')->group(function () {
        Route::post('queryChatList','ImController@queryChatList');
        Route::post('queryMsg','ImController@queryMsg');
        Route::post('send','ImController@send');
    });

    Route::prefix('public')->group(function () {
        Route::post('upload','PublicController@upload');
    });

});

