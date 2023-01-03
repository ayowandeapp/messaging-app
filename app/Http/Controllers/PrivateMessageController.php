<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\PrivateMessage;
use App\Events\SendMessage;

class PrivateMessageController extends Controller
{
    public function getUserNotifications()
    {
        $notifications = PrivateMessage::where(['receiver_id'=> auth()->user()->id, 'read'=>0])->orderBy('created_at','desc')->get();
        return response()->json(["data"=>$notification]);
    }

    public function getPrivateMessages()
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

        // $redis = Redis::connection(); //create a redis instance
        // $redis->publish('message',$getmessage);

        //event(new SendMessage($getmessage));
        broadcast(new SendMessage($getmessage))->toOthers();


        return response()->json(["data"=>$getmessage]);

    }

    public function getPrivateMessageSent()
    {
        $data = PrivateMessage::where('sender_id',auth()->user()->id)->orderBy('created_at','desc')->get();
        //$data = PrivateMessage::select('receiver_id','created_at')->where('sender_id',auth()->user()->id)->orderBy('created_at','desc')->distinct()->get();
        return response()->json(["data"=>$data]);
    }
}
