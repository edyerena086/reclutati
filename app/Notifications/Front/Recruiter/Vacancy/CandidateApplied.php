<?php

namespace ReclutaTI\Notifications\Front\Recruiter\Vacancy;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CandidateApplied extends Notification
{
    use Queueable;

    private $recruiterName;
    private $candidate;
    private $vacancy;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recruiterName, $candidate, $vacancy)
    {
        $this->recruiterName = $recruiterName;
        $this->candidate = $candidate;
        $this->vacancy = $vacancy;
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
        return (new MailMessage)->subject('Un candidato ha aplicado a tu vacante.')
                                ->markdown('emails.front.recruiter.vacancy.candidate-applied', [
                                    'recruiterName' => $this->recruiterName,
                                    'candidate' => $this->candidate,
                                    'vacancy' => $this->vacancy
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
