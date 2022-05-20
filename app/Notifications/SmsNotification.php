<?php

namespace App\Notifications;

use App\Channels\KavehNegarChannel;
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
        $this->connection = 'redis';
    }

    /**
     * Determine which queues should be used for each notification channel.
     *
     * @return array
     */
    public function viaQueues()
    {
        // php artisan queue:work redis --queue=sms-queue
        return [
            KavehNegarChannel::class => 'sms-queue',
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            KavehNegarChannel::class
        ];
    }

    public function toSms($notifiable)
    {
        return (new SmsMessage())
                    ->to($this->to)
                    ->message($this->message);
    }
}
