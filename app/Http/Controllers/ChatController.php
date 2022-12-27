<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;


class ChatController extends Controller
{
    public function getUserConversationById(Request $request)
    {
        $user_id = $request->id;
        $auth_user_id = auth()->user()->id;
        $chats = Chat::whereIn('sender_id',[$auth_user_id,$user_id])->whereIn('receiver_id',[$auth_user_id,$user_id])->orderBy('created_at','desc')->get();
        return response()->json(['data' => $chats]);
    }

    public function saveUserChat(Request $request)
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
        $finaldata = Chat::find($chat->id);
        return response()->json(['data' => $finaldata]);
    }
}
