<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function show()
    {
        $keyId = env('RAZORPAY_KEY_ID');
        $keySecret = env('RAZORPAY_KEY_SECRET');
        $displayCurrency = 'INR';

        $api = new Api($keyId, $keySecret);

        $orderData = [
            'receipt'         => 3456,
            'amount'          => 1999 * 100, // 1999 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpayOrderId = $razorpayOrder['id'];

        session()->put('razorpay_order_id', $razorpayOrderId);

        $displayAmount = $amount = $orderData['amount'];

        $data = [
            "key"               => $keyId,
            "amount"            => $amount,
            "name"              => "Dev Connect",
            "description"       => "A platform for beginners in programming...",
            "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
            "prefill"           => [
                "name"              => "{{ auth()->user()->name }}",
                "email"             => "{{ auth()->user()->email }}",
                "contact"           => "9876543219",
            ],
            "notes"             => [
                "address"           => "{{ auth()->user()->profile->location }}",
                "merchant_order_id" => "12312321",
            ],
            "theme"             => [
                "color"             => "#F37254"
            ],
            "order_id"          => $razorpayOrderId,
        ];

        $json = json_encode($data);

        return view('payment', compact('data'));
    }

    public function verify(Request $request)
    {
        $success = true;

        $error = "Payment Failed";

        if (empty($_POST['razorpay_payment_id']) === false)
        {
            $keyId = env('RAZORPAY_KEY_ID');
            $keySecret = env('RAZORPAY_KEY_SECRET');
            $displayCurrency = 'INR';

            $api = new Api($keyId, $keySecret);

            try
            {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => session()->pull('razorpay_order_id'),
                    'razorpay_payment_id' => $request->get('razorpay_payment_id'),
                    'razorpay_signature' => $request->get('razorpay_signature')
                );

                $api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success === true)
        {
            auth()->user()->assignRole('Premium');
            return view('success', compact('attributes'));
        }
        else
        {
            $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
        }

        echo $html;

    }
}
