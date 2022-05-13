<?php


namespace App\Channels\Messages;


class SmsMessage
{

    /**
     * The devices token to send the message from.
     *
     * @var array|string
     */
    public $to;

    /**
     * The devices token to send the message from.
     *
     * @var array|string
     */
    public $from;

    /**
     * The data of the Sms message.
     *
     * @var array
     */
    public $message;


    /**
     *
     * @param  array|string  $to
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     *
     * @param  array|string  $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the message of the sms.
     *
     * @param  string  $message
     * @return $this
     */
    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

}
