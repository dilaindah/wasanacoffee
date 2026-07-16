<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Menyusun link reset password
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Atur Ulang Password Akun Wasana Coffee Anda')
            ->greeting('Halo, Pelanggan Wasana Coffee!')
            ->line('Kami menerima permintaan untuk mengatur ulang (reset) password akun Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kedaluwarsa dalam waktu 60 menit.')
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.')
            ->salutation('Salam Hangat, Team Wasana Coffee');
    }
}