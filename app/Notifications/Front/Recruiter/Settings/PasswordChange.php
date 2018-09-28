<?php

namespace ReclutaTI\Notifications\Front\Recruiter\Settings;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordChange extends Notification
{
    use Queueable;

    private $userName;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
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
        return (new MailMessage)->subject('Se ha cambiado tu contraseña.')
                                ->markdown('emails.front.recruiter.settings.password-change', ['userName' => $this->userName, 'password' => $this->password]);
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
