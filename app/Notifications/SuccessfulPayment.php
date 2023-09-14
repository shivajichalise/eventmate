<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfulPayment extends Notification
{
    use Queueable;
    private $invoiceId;

    /**
     * Create a new notification instance.
     */
    public function __construct($invoiceId)
    {
        $this->invoiceId = $invoiceId;
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
        $invoice = Invoice::find($this->invoiceId);

        return (new MailMessage())
            ->subject('Successful Payment')
            ->line('Woohoo! Your payment was successful.')
            ->line('Please look for you payment receipt that is attached with this mail.')
            ->line('Thank you for participating. See you in the field!')
            ->attach(public_path('/receipts/' . $invoice->number . '.pdf'), [
                'as' => 'receipt.pdf',
                'mime' => 'application/pdf',
            ]);
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
