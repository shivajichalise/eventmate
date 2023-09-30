<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\SuccessfulPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KhaltiController extends Controller
{
    public function getMerchantCode(): mixed
    {
        return env('KHALTI_MERCHANT_CODE');
    }

    public function getPaymentUrl(): string
    {
        return 'https://a.khalti.com/api/v2/epayment/initiate/';
    }

    public function getWebsiteUrl(): string
    {
        $site_url = env('APP_URL');
        return $site_url;
    }

    public function getReturnUrl(): string
    {
        $return_url = env('APP_URL') . '/khalti/verify/';
        return $return_url;
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
                'total' => round((($ticket->tax / 100) * $price) + $price),
            ];
        } else {
            $amounts = [
                'price' => round($ticket->price),
                'subTotal' => round($ticket->price),
                'tax' => round(($ticket->tax / 100) * $ticket->price),
                'total' => round((($ticket->tax / 100) * $ticket->price) + $ticket->price),
            ];
        }

        return $amounts;
    }

    public function pay(Invoice $invoice)
    {
        $user = Auth::user();
        $ticket = Ticket::find($invoice->ticket_id);
        $sub_event = $ticket->subEvent;

        $amounts = $this->getAmounts($ticket);

        Session::put('ticket', [
            'ticket' => $ticket,
            'amounts' => $amounts,
            'invoice' => $invoice
        ]);

        $curl = curl_init();

        $request = array(
            "return_url" => $this->getReturnUrl(),
            "website_url" => $this->getWebsiteUrl(),
            "amount" => $amounts["total"],
            "purchase_order_id" => $ticket->id,
            "purchase_order_name" => $sub_event->name,
            "customer_info" => array(
                "name" => $user->name,
                "email" => $user->email,
            ),
            "amount_breakdown" => array(
                array(
                    "label" => "Price",
                    "amount" => $amounts["subTotal"]
                ),
                array(
                    "label" => "Tax",
                    "amount" => $amounts["tax"]
                )
            ),
            "product_details" => array(
                array(
                    "identity" => $ticket->id,
                    "name" => $sub_event->name,
                    "total_price" => $amounts["total"],
                    "quantity" => 1,
                    "unit_price" => $amounts["total"]
                )
            )
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response, true);
        if (isset($res['payment_url'])) {
            $value = $res['payment_url'];
            return redirect()->away($value);
            echo "Value of Payment Url: $value";
        } else {
            echo $response;
            echo "Key payment_url not found in JSON data.";
        }
    }

    public function verify(Request $request)
    {
        $ticket = Session::get('ticket');

        $message = $request->has('message');
        if($message) {
            $error = $request->message;
            Session::regenerate();
            return redirect()->route('event.view', ['subevent' => $ticket['ticket']->subEvent->id])->with(
                'message',
                ['type' => 'error', 'message' => 'Payment failed! Error: '. $error],
            );
        }

        Payment::updateOrCreate(
            [
                'invoice_id' => $ticket['invoice']->id
            ],
            [
                'amount' => $ticket['amounts']['total'],
                'paid' => true,
                'status' => 'verified'
            ]
        );

        $invoice =  Invoice::find($ticket['invoice']->id);
        $invoice->update(['status' => 'paid']);

        (new ReceiptController())->generate($invoice->id);
        User::find($invoice->user_id)->notify(new SuccessfulPayment($invoice->id));

        Session::regenerate();

        return redirect(route('dashboard'))->with(
            'message',
            ['type' => 'success', 'message' => 'Payment successful!'],
        );
    }
}
