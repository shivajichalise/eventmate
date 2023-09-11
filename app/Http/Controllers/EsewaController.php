<?php

namespace App\Http\Controllers;

use App\Http\Requests\Esewa\EsewaPayRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class EsewaController extends Controller
{
    public function getMerchantCode(): mixed
    {
        return env('ESEWA_MERCHANT_CODE');
    }

    public function getPaymentUrl(): string
    {
        return 'https://uat.esewa.com.np/epay/main';
    }

    public function getSuccessUrl(): string
    {
        return 'http://merchant.com.np/page/esewa_payment_success?q=su';
    }

    public function getVerificationUrl(): string
    {
        return 'https://uat.esewa.com.np/epay/transrec';
    }

    public function getFailureUrl(): string
    {
        return 'http://merchant.com.np/page/esewa_payment_failed?q=fu';
    }

    public function pay(Request $request)
    {
        $url = $this->getPaymentUrl();
        $fields = $request;

        $data = [
            'amt' => $fields['amt'],
            'psc' => $fields['psc'],
            'pdc' => $fields['pdc'],
            'txAmt' => $fields['txAmt'],
            'tAmt' => $fields['tAmt'],
            'pid' => $fields['pid'],
            'scd' => $this->getMerchantCode(),
            'su' => $this->getSuccessUrl(),
            'fu' => $this->getFailureUrl()
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);
    }

    public function verify(Request $request)
    {
        $status = $request->q;
        $refId = $request->refId;
        $ticket = Session::get('ticket');

        // return $status;

        if($status == 'su') {
            $url = $this->getVerificationUrl();
            $data = [
                'amt' => $ticket['amounts']['total'],
                'rid' => $refId,
                'pid' => $ticket['id'],
                'scd' => 'EPAYTEST'
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            if (strpos($response, 'Success')) {
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

                Invoice::find($ticket['invoice']->id)->update(['status' => 'paid']);

                Session::regenerate();

                return Inertia::render('Dashboard', [
                    'message' => ['type' => 'success', 'message' => 'Payment successful!'],
                ]);

            } else {
                Session::regenerate();
                return redirect(route('event.view', ['subevent' => $ticket['ticket']->subEvent->id]))->with(
                    'message',
                    ['type' => 'error', 'message' => 'Payment failed!'],
                );
            }

        } else {
            Session::regenerate();
            return redirect()->route('event.view', ['subevent' => $ticket['ticket']->subEvent->id])->with(
                'message',
                ['type' => 'error', 'message' => 'Payment failed!'],
            );
        }

    }
}
