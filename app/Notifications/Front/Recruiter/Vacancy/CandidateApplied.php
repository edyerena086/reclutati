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
            'user_type' => 1,
            'notification_type' => 1,
            'icon' => 'icon-feather-users',
            'message_to_display' => 'El candidato '.$this->candidate.' ha aplicado para la vacante de '.$this->vacancy,
            'url' => url('recruiter/dashboard/vacancies')
        ];
    }
}
