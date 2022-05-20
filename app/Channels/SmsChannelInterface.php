<?php


namespace App\Channels;

use App\Channels\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;

interface SmsChannelInterface
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification);
}
