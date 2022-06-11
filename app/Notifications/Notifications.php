<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
{
    use Queueable;
    private $notificationData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationData)
    {
        $this->notificationData = $notificationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = (new MailMessage);

        if (isset($this->notificationData['body'])){
            $data = $data->line($this->notificationData['body']);
        }

        if (isset($this->notificationData['text']) && isset($this->notificationData['url'])){
            $data = $data->action($this->notificationData['text'], url($this->notificationData['url']));
        }
        if (isset($this->notificationData['thankyou'])){
            $data = $data->line($this->notificationData['thankyou']);
        }

        return $data;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->notificationData;
    }
}
