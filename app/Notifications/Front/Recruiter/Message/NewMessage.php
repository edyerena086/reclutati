<?php

namespace ReclutaTI\Notifications\Front\Recruiter\Message;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessage extends Notification
{
    use Queueable;

    private $recruiterName;
    private $candidateName;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recruiterName, $candidateName, $message)
    {
        $this->recruiterName = $recruiterName;
        $this->candidateName = $candidateName;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Nuevo mensaje de '.$this->recruiterName)
                                ->markdown('emails.front.recruiter.message.new', [
                                    'recruiterName' => $this->recruiterName,
                                    'candidateName' => $this->candidateName,
                                    'message' => $this->message
                                ]);
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
            //
        ];
    }
}
