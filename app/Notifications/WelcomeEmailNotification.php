<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class WelcomeEmailNotification extends Notification
{
    use Queueable;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $adminSetting = \App\Models\AdminSetting::first();
        return (new MailMessage)
            ->subject('Welcome to ' . ($adminSetting->site_name ?? 'Coinledger'))
            ->markdown('emails.welcome_email', [
                'user' => $this->user,
                'adminSetting' => $adminSetting,
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
