<?php

namespace Hmimeee\TextLocal\Channels;

use Throwable;
use Hmimeee\TextLocal\TextLocal;
use Illuminate\Notifications\Notification;
use Hmimeee\TextLocal\Events\TextLocalResultEvent;
use Hmimeee\TextLocal\Exceptions\TextLocalException;

class TextLocalChannel
{
    /**
     * The api key that will be used while send.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The sender that will be used while send.
     *
     * @var string
     */
    protected $sender;

    /**
     * Create a new Vonage channel instance.
     *
     * @param  \Hmimeee\Easysendsms\Easysendsms  $client
     * @param  string  $from
     * @return void
     */
    public function __construct(string $apiKey, string $sender)
    {
        $this->apiKey = $apiKey;
        $this->sender = $sender;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
                return;
            }

            //Grab the message first
            $message = $notification->toSms($notifiable);

            //Intstantiate the TextLocal for sending sms
            $client = new TextLocal($this->apiKey);

            $result = $client->sendSms([$to], $message, $this->sender);

            TextLocalResultEvent::dispatch($result);
            
        } catch (Throwable $th) {
            throw new TextLocalException($th->getMessage(), $th->getCode(), $th);
        }
    }
}
