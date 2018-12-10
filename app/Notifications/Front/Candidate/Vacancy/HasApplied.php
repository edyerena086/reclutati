<?php

namespace ReclutaTI\Notifications\Front\Candidate\Vacancy;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HasApplied extends Notification
{
    use Queueable;

    private $candidateName;
    private $vacancyTitle;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($candidateName, $vacancyTitle)
    {
        $this->candidateName = $candidateName;
        $this->vacancyTitle = $vacancyTitle;
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
        return (new MailMessage)->subject('Has aplicado a una vacante.')
                                ->markdown('emails.front.candidate.vacancy.has-applied', [
                                    'candidateName' => $this->candidateName,
                                    'vacancyTitle' => $this->vacancyTitle
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
