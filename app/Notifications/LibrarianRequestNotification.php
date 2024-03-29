<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LibrarianRequestNotification extends Notification
{
    use Queueable;
    public $info_lib;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info_lib)
    {
        $this->info_lib = $info_lib;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => $this->info_lib['info'],
            'userID' => $this->info_lib['user_id'],
            'userFirstName' => $this->info_lib['user_firstName'],
            'userLastName' => $this->info_lib['user_lastName'],
            'type' => $this->info_lib['type']
        ];
    }
}
