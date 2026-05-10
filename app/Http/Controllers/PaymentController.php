<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    // Create checkout session
    public function checkout(Request $request)
    {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price'    => config('services.stripe.price_pro'),
                'quantity' => 1,
            ]],
            'mode'        => 'subscription',
            'success_url' => url('/payment/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url'  => url('/payment/cancel'),
        ]);

        return response()->json(['url' => $session->url]);
    }

    public function success(Request $request)
    {
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}