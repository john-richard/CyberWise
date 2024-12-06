<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Password Reset Request')
            ->line('Click the button below to reset your password.')
            ->action('Reset Password', url("/reset-password/{$this->token}"))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
