<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\User;
use App\Events\ChatCreated;

class ChatController extends Controller
{
    public function authUser(){
        return auth()->user()->id;
    }
    public function getUser()
    {
        $user_id = auth()->user()->id;
        $users = User::orderBy('name','asc')->get();
        return response()->json(['data'=>$users,'authUser'=>$user_id]);
    }


    public function getUserConversationById(Request $request)
    {
        $user_id = $request->id;
        $auth_user_id = auth()->user()->id;
        $chats = Chat::whereIn('sender_id',[$auth_user_id,$user_id])->whereIn('receiver_id',[$auth_user_id,$user_id])->orderBy('created_at','asc')->get();
        return response()->json($chats);
    }

    public function addNewChat(Request $request)
    {
        $sender_id = auth()->user()->id;
        $receiver_id = $request->receiver_id;
        $chatText = $request->chat;
        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'chat' => $chatText,
            'read' => 1];
        $chat = Chat::create($data);
        //$finaldata = Chat::find($chat->id);

        event(new ChatCreated($chat));

        return response()->json($chat);
    }
}
