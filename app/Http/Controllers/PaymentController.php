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
use AmrShawky\LaravelCurrency\Facade\Currency;

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

    private function getAmounts(Ticket $ticket)
    {
        $currency = $ticket->currency;

        $amounts = [];

        if($currency !== 'NPR') {
            $price = Currency::convert()
            ->from($currency)
            ->to('NPR')
            ->amount($ticket->price)
            ->round(1)
            ->get();

            $amounts = [
                'price' => round($price),
                'subTotal' => round($price),
                'tax' => round(($ticket->tax / 100) * $price),
                'service_charge' => 0,
                'delivery_charge' => 0,
                'total' => round((($ticket->tax / 100) * $price) + $price),
            ];
        } else {
            $amounts = [
                'price' => round($ticket->price),
                'subTotal' => round($ticket->price),
                'tax' => round(($ticket->tax / 100) * $ticket->price),
                'service_charge' => 0,
                'delivery_charge' => 0,
                'total' => round((($ticket->tax / 100) * $ticket->price) + $ticket->price),
            ];
        }

        return $amounts;
    }

    public function buy(Ticket $ticket)
    {
        $event = $ticket->event;
        $subevent = $ticket->subEvent;
        $event = $subevent->event;
        $user = Auth::user();

        $site_url = env('APP_URL');
        $merchant_code = '8gBm/:&EnhH.1/q';
        // $pay_url = "https://uat.esewa.com.np/epay/main"; // Development
        $pay_url = "http://rc-epay.esewa.com.np/api/epay/main/v2/form";
        $success_url = $site_url . "/esewa/verify?q=su";
        $failure_url = $site_url . "/esewa/verify?q=fu";

        $amounts = $this->getAmounts($ticket);

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

        $signed_field_names = $amounts['total'] .','. $ticket['uniqueId'] .','. $merchant_code;
        // $signed_field_names = 'total_amount='. $amounts['total'] .',transaction_uuid='. $ticket['uniqueId'] .',product_code='. $merchant_code;
        $signature = base64_encode(hash_hmac('sha256', $signed_field_names, $merchant_code, true));

        return Inertia::render('Payment/Invoice', [
            'user' => $user,
            'event' => $event,
            'sub_event' => $subevent,
            'ticket' => $ticket,
            'amounts' => $amounts,
            'invoice' => $invoice,
            'pay_url' => $pay_url,
            'signed_field_names' => $signed_field_names,
            'signature' => $signature,
            'success_url' => $success_url,
            'failure_url' => $failure_url
        ]);
    }

    public function show(Payment $payment)
    {
        $invoice = $payment->invoice;
        $user = $invoice->user;
        $ticket = $invoice->ticket;
        $sub_event = $ticket->subEvent;

        $data = [
            'Sub event' => $sub_event->name,
            'Ticket code' => $ticket->code,
            'Invoice number' => $invoice->number,
            'Amount' => $invoice->amount,
            'Tax' => $invoice->tax,
            'Discount' => $invoice->discount,
            'Total amount' => $invoice->total_amount,
            'Paid amount' => $payment->amount,
            'Paid status' => $payment->paid,
            'Payment verified?' => $payment->status,
        ];

        return view('payments.show')->with([
            'invoice' => $invoice,
            'payment' => $payment,
            'ticket' => $ticket,
            'sub_event' => $sub_event,
            'user' => $user,
            'data' => $data,
        ]);
    }
}
