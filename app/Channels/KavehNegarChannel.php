<?php


namespace App\Channels;

use App\Channels\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;
use Kavenegar\KavenegarApi;

class KavehNegarChannel extends SmsChannel
{

    protected $kavenegar;

    /**
     * The API URL for sms.
     *
     * @var string
     */
    protected $sms_url;

    /**
     * The api key for sms inside sms.ir panel.
     *
     * @var string
     */
    protected $api_key;

    /**
     * The secret key for sms inside sms.ir panel.
     *
     * @var string
     */
    protected $secret_key;

    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Create a new Socket channel instance.
     *
     * @param  \GuzzleHttp\Client  $http
     * @return void
     */
    public function __construct(KavenegarApi $kavenegar, $from = null)
    {
        $this->from = $from;
        $this->kavenegar = $kavenegar;
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
        if (!$message->to || $message->from || $message->message) {
            return;
        }

        $this->kavenegar->Send($this->from, $message->to, $message->message);

    }
}
