<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;
use App\Notifications\UserRegisterNotification;

class SendEmailVerification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {        
        $user = $event->user;
        //send the mail
        $details = [
                'name' => $user->name,
                'verify_token' => $user->verify_token
            ];
        $save = Notification::send($user, new UserRegisterNotification($details));
        return $save;
    }
}
