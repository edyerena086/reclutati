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
    private $companyName;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recruiterName, $candidateName, $companyName, $message)
    {
        $this->recruiterName = $recruiterName;
        $this->candidateName = $candidateName;
        $this->companyName = $companyName;
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
        return ['mail', 'database'];
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
                                    'companyName' => $this->companyName,
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
            'message_to_display' => $this->recruiterName.' te ha enviado un nuevo mensaje directo.',
            'icon' => 'icon-feather-message-square',
            'url' => 'candidate/dashboard/messages'
        ];
    }
}
