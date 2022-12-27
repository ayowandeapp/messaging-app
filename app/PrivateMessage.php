<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class PrivateMessage extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id','read','subject','message'];
        //add the sender and receiver attribute
    protected $appends=['sender', 'receiver'];
    //override the created_at coming from the table
    protected $casts=['created_at'];

    //protected attribute

    public function getSenderAttribute()
    {
        return User::where('id', $this->sender_id)->first();
    }

    public function getReceiverAttribute($value='')
    {
        return User::where('id', $this->receiver_id)->first();

    }
    //this will pass and override the created_at coming from the table
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
