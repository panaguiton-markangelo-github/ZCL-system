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
        else if($this->info['avail_date'] == "card_approve" && $this->info['due_date'] == "card_approve"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Borrower Card Application was approved.'))
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "card_decline" && $this->info['due_date'] == "card_decline"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Borrower Card Application was declined.'))
            ->line('Remarks: '.$this->info['remarks'])
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "register" && $this->info['due_date'] == "register"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('You have successfully applied for a borrower card.'))
            ->line('Important Note!')
            ->line('Your borrower card application was sent for approval. However, you can start using you ZCL account by verifying your account email thru the email sent by the system and logging into the ZCL online portal.')
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "book_req" && $this->info['due_date'] == "book_req"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Book Borrow Request was sent successfully.'))
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "borrower_card_app" && $this->info['due_date'] == "borrower_card_app"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Borrower Card Application was successfully sent for approval.'))
            ->line('This is a system generated message, do not reply here!');
        }
        else if($this->info['avail_date'] == "borrower_card_update" && $this->info['due_date'] == "borrower_card_update"){
            return (new MailMessage)
            ->greeting('Greetings '.$this->info['username'].'!')
            ->subject(Lang::get('Your Borrower Card was updated successfully.'))
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
