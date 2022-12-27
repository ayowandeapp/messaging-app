<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivateMessage;

class PrivateMessageController extends Controller
{
    public function getUserNotifications($value='')
    {
        $notifications = PrivateMessage::where(['receiver_id'=> auth()->user()->id, 'read'=>0])->orderBy('created_at','desc')->get();
        return response()->json(["data"=>$notification]);
    }

    public function getPrivateMessages($value='')
    {
        $data = PrivateMessage::where('receiver_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return response()->json(["data"=>$data]);
    }

    public function getPrivateMessageById(Request $request)
    {
        $data = PrivateMessage::find($request->id);
        if($data->read == 0){
            $data->update(['read'=>1]);
        }
        return response()->json(["data"=>$data]);

    }

    public function sendPrivateMessage(Request $request)
    {
        $data = [
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'read' => 0];
        $data = PrivateMessage::create($data);
        $getmessage = PrivateMessage::find($data->id);
        return response()->json(["data"=>$getmessage]);

    }

    public function getPrivateMessageSent($value='')
    {
        $data = PrivateMessage::where('sender_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        return response()->json(["data"=>$data]);
    }
}
