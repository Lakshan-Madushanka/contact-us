<?php

namespace Lakm\Contact;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Lakm\Contact\Events\NotifyAdminReplied;
use Lakm\Contact\Events\Replied;
use Lakm\Contact\Events\UserInqured;
use Lakm\Contact\Listeners\SendAdminRepliedNotification;
use Lakm\Contact\Listeners\SendUserInqueryNotification;
use Lakm\Contact\Listeners\SendUserReplyNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserInqured::class => [
            SendUserInqueryNotification::class
        ],
        Replied::class => [
            SendUserReplyNotification::class
        ],
        NotifyAdminReplied::class => [
            SendAdminRepliedNotification::class
            ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
