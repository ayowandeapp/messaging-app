<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Chat extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id','read','chat'
    ];
    protected $casts =['created_at'];
    protected $appends=['sender', 'receiver'];

    //protected attribute

    public function getSenderAttribute()
    {
        return User::where('id', $this->sender_id)->first();
    }

    public function getReceiverAttribute($value='')
    {
        return User::where('id', $this->receiver_id)->first();

    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
