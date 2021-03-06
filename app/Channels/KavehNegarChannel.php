<?php


namespace App\Channels;

use App\Channels\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;
use Kavenegar\KavenegarApi;

class KavehNegarChannel implements SmsChannelInterface
{

    protected $kavenegar;

    /**
     * Create a new Socket channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->from = config()->get('kavenegar.from');
        $this->kavenegar = new KavenegarApi(config()->get('kavenegar.apikey'));
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        
        $message->to($message->to);
        if (!$message->to || $message->message) {
            return;
        }

        $this->kavenegar->Send($this->from, $message->to, $message->message);
    }
}
