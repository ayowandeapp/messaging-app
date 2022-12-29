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

Route::get('/account-verify/{token}', [App\Http\Controllers\GuestController::class,'verify'])->middleware(['guest']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/get-private-message-notifications','PrivateMessageController@getUserNotifications');
Route::post('/get-private-messages','PrivateMessageController@getPrivateMessages');
Route::post('/get-private-message','PrivateMessageController@getPrivateMessageById');
Route::post('/send-private-message','PrivateMessageController@sendPrivateMessage');
Route::post('/get-private-messages-sent','PrivateMessageController@getPrivateMessageSent');

Route::get('/get-users','ChatController@getUser');
Route::get('/authUser','ChatController@authUser');

Route::post('/get-user-conversation','ChatController@getUserConversationById');
Route::post('/add-new-chat','ChatController@addNewChat');


