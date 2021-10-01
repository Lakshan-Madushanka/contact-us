<?php

namespace Lakm\Contact\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotifyReply extends Notification
{
    //use Queueable;

    private $reply;
    private $contact;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact, $reply)
    {
        $this->contact = $contact;
        $this->reply = $reply;
        print_r($reply);
        echo 'dddddddddddddd';

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello,  '.current($notifiable->routes['mail']))
            ->subject('Replied to inquery')
            ->line('Following inquery replied')
            ->line('Inquery No : '.$this->contact->id)
            ->line('Inquery Name : '.$this->contact->name)
            ->line('Inquery Email : '.$this->contact->email)
            ->line('Inquery')
            ->line($this->contact->description)
            ->line('Reply')
            ->line('Subject : '. $this->reply['subject'])
            ->line($this->reply['message'])
            ->action('Show Reply', route('contactUs.admins.getReply', $this->contact->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
