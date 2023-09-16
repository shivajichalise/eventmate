<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResultPublished extends Notification implements ShouldQueue
{
    use Queueable;

    private $result;
    private $subEvent = null;

    /**
     * Create a new notification instance.
     */
    public function __construct($result)
    {
        $this->subEvent = $result->subEvent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Result Published!')
            ->line('The result for ' . $this->subEvent->name .' event has been published.')
            ->line('You can view the result by loggin into the app.')
            ->action('View Result', url('/tickets'))
            ->line('Thank you for your participation!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
