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

class UserInqured
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contact;
    public $users;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, $users)
    {
        $this->contact = $contact;
        $this->users = $users;
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
