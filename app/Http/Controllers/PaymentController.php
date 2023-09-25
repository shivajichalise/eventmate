<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentsDataTable;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaymentsDataTable $dataTable)
    {
        return $dataTable->render('payments.index');
    }

    public function generateUniqueId(string $ticketId): string
    {
        // Get the current timestamp in microseconds (to ensure uniqueness)
        $timestamp = microtime(true) * 10000;

        // Concatenate the ticket ID with the timestamp
        $uniqueId = $ticketId.$timestamp;

        return $uniqueId;
    }
    public function buy(Ticket $ticket): Response
    {
        $event = $ticket->event;
        $subevent = $ticket->subEvent;
        $event = $subevent->event;
        $user = Auth::user();

        $site_url = env('APP_URL');
        $pay_url = "https://uat.esewa.com.np/epay/main"; // Development
        $success_url = $site_url . "/esewa/verify?q=su";
        $failure_url = $site_url . "/esewa/verify?q=fu";

        $amounts = [
            'price' => $ticket->price,
            'subTotal' => $ticket->price,
            'tax' => ($ticket->tax / 100) * $ticket->price,
            'service_charge' => 0,
            'delivery_charge' => 0,
            'total' => (($ticket->tax / 100) * $ticket->price) + $ticket->price,
        ];

        $invoice = Invoice::updateOrCreate(
            [
                'user_id' => $user->id,
                'ticket_id' => $ticket->id
            ],
            [
                'amount' => $amounts['subTotal'],
                'tax' => $amounts['tax'],
                'service_charge' => $amounts['service_charge'],
                'discount_charge' => $amounts['delivery_charge'],
                'total_amount' => $amounts['total'],
            ]
        );

        $ticket['uniqueId'] = $this->generateUniqueId($ticket->id);

        Session::put('ticket', [
            'id' => $ticket['uniqueId'],
            'ticket' => $ticket,
            'amounts' => $amounts,
            'invoice' => $invoice
        ]);

        return Inertia::render('Payment/Invoice', [
            'user' => $user,
            'event' => $event,
            'sub_event' => $subevent,
            'ticket' => $ticket,
            'amounts' => $amounts,
            'invoice' => $invoice,
            'pay_url' => $pay_url,
            'success_url' => $success_url,
            'failure_url' => $failure_url
        ]);
    }

    public function show(Payment $payment)
    {
        return $payment->invoice;
    }
}
