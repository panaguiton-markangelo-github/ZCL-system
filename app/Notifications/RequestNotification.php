<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RequestNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->info['avail_date'] == "none" && $this->info['due_date'] == "none"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Book Request was Declined.'))
            ->line('Important Note!')
            ->line('Book Title: '.$this->info['book'])
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "cancel" && $this->info['due_date'] == "none"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Book Request was Cancelled.'))
            ->line('Important Note!')
            ->line('Book Title: '.$this->info['book'])
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "released"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Request Book was successfully released.'))
            ->line('Important Notes!')
            ->line('Lost/Damaged Books = Replacement.')
            ->line('Over-due fine = Php 2.00/day per book')
            ->line('Book Title: '.$this->info['book'])
            ->line($this->info['due_date'])
            ->line('This is a system generated message, do not reply here!');
        }
        else {
            return (new MailMessage)
                    ->greeting('Greetings '.$this->info['username'].'!')
                    ->subject(Lang::get('Available Date Pickup and Due Date for the Book'))
                    ->line('Important Note!')
                    ->line('Book Title: '.$this->info['book'])
                    ->line('Available Pick Up (Date and Time): '.$this->info['avail_date'])
                    ->line('Due Date for the books to be returned (Date and Time): '.$this->info['due_date'])
                    ->line('This is a system generated message, do not reply here!');
        }
        
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
            'data' => $this->info['info'],
            'remarks' => $this->info['remarks'],
            'userID' => $this->info['id'],
            'book_tile' => $this->info['book'],
            'username' => $this->info['username'],
            'avail_date' => $this->info['avail_date'],
            'due_date' => $this->info['due_date'],
        ];
    }
}
