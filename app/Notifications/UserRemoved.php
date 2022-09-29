<?php

namespace App\Notifications;

use Tzsk\Sms\Builder;
use Illuminate\Bus\Queueable;
use Tzsk\Sms\Channels\SmsChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRemoved extends Notification implements ShouldQueue
{
    use Queueable;

    public $phone;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('Your user account of site had been removed.');
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

    /**
     * Get the repicients and body of the notification.
     *
     * @param  mixed  $notifiable
     * @return Builder
     */
    public function toSms($notifiable)
    {
        return (new Builder)->via('gateway') # via() is Optional
            ->send('Your account was removed by Admin')
            ->to($this->phone);
    }
}
