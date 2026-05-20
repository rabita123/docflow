<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Redirect directly to Lemon Squeezy hosted checkout
    public function checkout(Request $request)
    {
        $checkoutUrl = config('services.lemonsqueezy.checkout_url');

        $params = [];

        if (Auth::check()) {
            $user = Auth::user();
            $params[] = 'checkout[email]='                    . urlencode($user->email);
            $params[] = 'checkout[name]='                     . urlencode($user->name);
            $params[] = 'checkout[custom][user_id]='          . $user->id;
            $params[] = 'checkout[custom][user_email]='       . urlencode($user->email);
        }

        // Redirect after payment — must also be set in LS dashboard:
        // Store → Products → PDFTash Pro → Edit → Confirmation URL
        $params[] = 'checkout[success_url]=' . urlencode(url('/payment/success'));

        $checkoutUrl .= '?' . implode('&', $params);

        return redirect($checkoutUrl);
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
        if (in_array($eventName, ['subscription_created', 'subscription_updated', 'order_created'])) {
            $attrs  = $data['data']['attributes'] ?? [];
            $meta   = $data['meta']['custom_data'] ?? [];

            $email            = $attrs['user_email'] ?? $attrs['customer_email'] ?? null;
            $userId           = $meta['user_id']    ?? null;
            $lsSubscriptionId = $data['data']['id'] ?? null;
            $lsCustomerId     = $attrs['customer_id'] ?? null;

            // Find user by ID first (most reliable), then fall back to email
            $user = null;
            if ($userId) {
                $user = \App\Models\User::find($userId);
            }
            if (!$user && $email) {
                $user = \App\Models\User::where('email', $email)->first();
            }

            if ($user) {
                $user->update([
                    'plan'                         => 'pro',
                    'lemonsqueezy_customer_id'     => $lsCustomerId,
                    'lemonsqueezy_subscription_id' => $lsSubscriptionId,
                    'pro_expires_at'               => now()->addYear(),
                ]);
                Log::info('PDFTash Pro activated for user ' . $user->email);
            } else {
                Log::warning('LS webhook: could not find user. email=' . $email . ' user_id=' . $userId);
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
        // Fallback upgrade — runs if webhook was delayed or missed
        if (Auth::check() && Auth::user()->plan !== 'pro') {
            Auth::user()->update(['plan' => 'pro', 'pro_expires_at' => now()->addYear()]);
            Log::info('Plan upgraded via success page fallback for: ' . Auth::user()->email);
        }

        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
