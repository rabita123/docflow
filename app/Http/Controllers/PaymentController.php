<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Redirect to Lemon Squeezy hosted checkout
    public function checkout(Request $request)
    {
        $checkoutUrl = config('services.lemonsqueezy.checkout_url');

        // If user is logged in, pre-fill their email
        if (Auth::check()) {
            $email = urlencode(Auth::user()->email);
            $checkoutUrl .= '?checkout[email]=' . $email;
        }

        return response()->json(['url' => $checkoutUrl]);
    }

    // Lemon Squeezy webhook — called after successful payment
    public function webhook(Request $request)
    {
        $secret    = config('services.lemonsqueezy.webhook_secret');
        $signature = $request->header('X-Signature');
        $payload   = $request->getContent();

        // Verify webhook signature
        if ($secret && $signature) {
            $expected = hash_hmac('sha256', $payload, $secret);
            if (!hash_equals($expected, $signature)) {
                return response('Invalid signature', 403);
            }
        }

        $data      = json_decode($payload, true);
        $eventName = $data['meta']['event_name'] ?? '';

        // Handle subscription created or order paid
        if (in_array($eventName, ['subscription_created', 'order_created'])) {
            $email = $data['data']['attributes']['user_email']
                  ?? $data['data']['attributes']['customer_email']
                  ?? null;

            $lsSubscriptionId = $data['data']['id'] ?? null;
            $lsCustomerId     = $data['data']['attributes']['customer_id'] ?? null;

            if ($email) {
                $user = \App\Models\User::where('email', $email)->first();
                if ($user) {
                    $user->update([
                        'plan'                     => 'pro',
                        'lemonsqueezy_customer_id'     => $lsCustomerId,
                        'lemonsqueezy_subscription_id' => $lsSubscriptionId,
                        'pro_expires_at'           => now()->addYear(),
                    ]);
                }
            }
        }

        // Handle subscription cancelled / expired
        if (in_array($eventName, ['subscription_cancelled', 'subscription_expired'])) {
            $lsSubscriptionId = $data['data']['id'] ?? null;
            if ($lsSubscriptionId) {
                \App\Models\User::where('lemonsqueezy_subscription_id', $lsSubscriptionId)
                    ->update(['plan' => 'free', 'pro_expires_at' => null]);
            }
        }

        return response('OK', 200);
    }

    public function success(Request $request)
    {
        // After payment, upgrade user if logged in (fallback if webhook is delayed)
        if (Auth::check() && Auth::user()->plan !== 'pro') {
            Auth::user()->update(['plan' => 'pro', 'pro_expires_at' => now()->addYear()]);
        }
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
