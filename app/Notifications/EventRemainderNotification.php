<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventRemainderNotification extends Notification
{
    use Queueable;
    private $sub_event;

    /**
     * Create a new notification instance.
     */
    public function __construct($sub_event)
    {
        $this->sub_event = $sub_event;
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
                    ->subject('Remainder!')
                    ->line('The event that you bought ticket for is near.')
                    ->line('Event name: ' . $this->sub_event->name)
                    ->line('Days until event start: ' . $this->sub_event->getRemainingDaysUntilEventStart())
                    ->action('View Event', url('/event/' . $this->sub_event->id))
                    ->line('Event starts on: ' . $this->sub_event->getEventStartDate())
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
