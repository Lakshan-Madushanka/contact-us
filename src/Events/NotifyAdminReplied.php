<?php

namespace Lakm\Contact\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lakm\Contact\Models\Contact;

class NotifyAdminReplied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contact;
    public $reply;
    public $users;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($users, Contact $contact, array $reply)
    {
        $this->users = $users;
        $this->contact = $contact;
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
