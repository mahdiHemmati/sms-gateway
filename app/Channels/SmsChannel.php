<?php


namespace App\Channels;

use App\Channels\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;

abstract class SmsChannel
{
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
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public abstract function send($notifiable, Notification $notification);
}
