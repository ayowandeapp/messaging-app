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

Route::post('/get-private-message-notifications','PrivateMessageController@getUserNotifications');
Route::post('/get-private-messages','PrivateMessageController@getPrivateMessages');
Route::post('/get-private-message','PrivateMessageController@getPrivateMessageById');
Route::post('/send-private-message','PrivateMessageController@sendPrivateMessage');
Route::post('/get-private-messages-sent','PrivateMessageController@getPrivateMessageSent');


Route::get('/get-users','ChatController@getUser');
Route::get('/authUser','ChatController@authUser');