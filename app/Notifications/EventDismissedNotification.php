<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventDismissedNotification extends Notification
{
    use Queueable;

    private $event;

    /**
     * Create a new notification instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
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
            ->subject('Apology for Event Dismissal')
            ->line('We hope this message finds you well.')
            ->line('We would like to extend our sincere apologies for the recent dismissal of the event you were interested in, ' . $this->event->name . '.')
            ->line('The decision to dismiss the event was not taken lightly, and it was made after careful consideration of various factors.')
            ->line('Please rest assured that we are actively working to resolve any issues that led to this dismissal, and we are committed to providing you with an even better event experience in the future.')
            ->line('In the meantime, if you have any questions or concerns regarding this matter or any other aspect of our service, please do not hesitate to reach out to our customer support team.')
            ->action('Contact Customer Support', url('/contact'))
            ->line('Once again, we apologize for any inconvenience caused and thank you for your understanding. We value your continued support and hope to have the opportunity to serve you better in the future.')
            ->line('Thank you for your participation.');
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
