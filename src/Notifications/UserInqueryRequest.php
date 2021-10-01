<?php

namespace Lakm\Contact\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInqueryRequest extends Notification implements ShouldQueue
{
    use Queueable;

    private $inquery;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inquery)
    {
        $this->inquery = $inquery;
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
            ->line('Following User made a inquery.')
            ->line('name : '.$this->inquery->name)
            ->line( 'email : '.$this->inquery->email)
            ->line('Inquery Deatails :')
            ->line($this->inquery->description)
            ->action('Reply', route('admins.reply', $this->inquery->id))
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
