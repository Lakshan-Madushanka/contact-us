<?php

namespace Lakm\Contact\Listeners;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Lakm\Contact\Events\UserInqured;
use Lakm\Contact\Notifications\UserInqueryRequest;

class SendUserInqueryNotification
{
    //public $delay = 20;
    //public $connection = 'database';
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
     * @param  UserInqured  $event
     *
     * @return void
     */
    public function handle(UserInqured $inquery)
    {
        //Notification::route('mail', ['e@gmail.com'])->notify(new UserInqueryRequest($inquery->contact));
        $inquery->users->each(function ($admin) use ($inquery) {
            echo 'hahhahhahahahah';
            Notification::route('mail', [
                $admin->email => $admin->name
            ])->notify(new UserInqueryRequest($inquery->contact));
        });
    }
}
