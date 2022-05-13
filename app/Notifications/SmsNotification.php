<?php

namespace App\Notifications;

use App\Channels\Messages\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SmsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $from;

    protected $to;

    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($to, $message)
    {
        $this->to = $to;
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
        return ['kaveh_sms'];
    }

    public function toSms($notifiable)
    {
        return (new SmsMessage())
                    ->to($this->to)
                    ->message($this->message);
    }
}
