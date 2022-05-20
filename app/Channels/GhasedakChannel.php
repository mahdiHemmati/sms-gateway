<?php


namespace App\Channels;

use App\Channels\Messages\SmsMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;
use ghasedak\GhasedakApi;
use Ghasedak\Laravel\GhasedakFacade;

class GhasedakChannel implements SmsChannelInterface
{

    protected $kavenegar;

    /**
     * Create a new Socket channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->from = config()->get('sms.ghasedak.from');
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

        GhasedakFacade::SendSimple($message->to, $message->message, $this->from);
    }
}
