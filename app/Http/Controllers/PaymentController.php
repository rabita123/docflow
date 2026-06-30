<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Paddle Billing: the checkout is opened client-side via Paddle.js overlay.
     * This endpoint just returns the data the JS needs (price ID, prefill email).
     */
    public function checkoutData(Request $request)
    {
        $data = [
            'price_id' => config('services.paddle.price_id'),
        ];

        if (Auth::check()) {
            $data['email'] = Auth::user()->email;
            $data['user_id'] = Auth::user()->id;
        }

        return response()->json($data);
    }

    /**
     * Paddle Billing webhook — handles subscription lifecycle events.
     * Endpoint: POST /payment/webhook
     * Register this URL in Paddle → Developer Tools → Notifications.
     */
    public function webhook(Request $request)
    {
        $secret    = config('services.paddle.webhook_secret');
        $signature = $request->header('Paddle-Signature');
        $payload   = $request->getContent();

        // Verify webhook signature (HMAC-SHA256)
        if ($secret && $signature) {
            // Paddle sends: ts=timestamp;h1=hash
            $parts = [];
            foreach (explode(';', $signature) as $part) {
                [$k, $v] = explode('=', $part, 2);
                $parts[$k] = $v;
            }
            $ts   = $parts['ts'] ?? '';
            $hash = $parts['h1'] ?? '';
            $expected = hash_hmac('sha256', $ts . ':' . $payload, $secret);
            if (!hash_equals($expected, $hash)) {
                Log::warning('Paddle webhook: invalid signature');
                return response('Invalid signature', 403);
            }
        }

        $data      = json_decode($payload, true);
        $eventType = $data['event_type'] ?? '';

        Log::info('Paddle webhook received: ' . $eventType);

        // Subscription activated or updated → grant Pro
        if (in_array($eventType, ['subscription.activated', 'subscription.updated'])) {
            $sub        = $data['data'] ?? [];
            $customData = $sub['custom_data'] ?? [];
            $userId     = $customData['user_id'] ?? null;
            $email      = $sub['customer_email'] ?? null;
            $paddleSubId = $sub['id'] ?? null;
            $paddleCustId = $sub['customer_id'] ?? null;

            // Subscription is active only if status is active or trialing
            $status = $sub['status'] ?? '';
            if (!in_array($status, ['active', 'trialing'])) {
                return response('OK', 200);
            }

            $user = $this->findUser($userId, $email);
            if ($user) {
                $user->update([
                    'plan'                    => 'pro',
                    'paddle_customer_id'      => $paddleCustId,
                    'paddle_subscription_id'  => $paddleSubId,
                    'pro_expires_at'          => now()->addYear(),
                ]);
                Log::info('PDFTash Pro activated via Paddle for: ' . $user->email);
            } else {
                Log::warning('Paddle webhook: user not found. email=' . $email . ' user_id=' . $userId);
            }
        }

        // Subscription cancelled or past_due → downgrade
        if (in_array($eventType, ['subscription.canceled', 'subscription.past_due'])) {
            $sub         = $data['data'] ?? [];
            $paddleSubId = $sub['id'] ?? null;
            if ($paddleSubId) {
                \App\Models\User::where('paddle_subscription_id', $paddleSubId)
                    ->update(['plan' => 'free', 'pro_expires_at' => null]);
                Log::info('PDFTash Pro cancelled via Paddle for subscription: ' . $paddleSubId);
            }
        }

        // One-time payment completed (if you sell one-time Pro)
        if ($eventType === 'transaction.completed') {
            $txn        = $data['data'] ?? [];
            $customData = $txn['custom_data'] ?? [];
            $userId     = $customData['user_id'] ?? null;
            $email      = $txn['customer']['email'] ?? null;
            $paddleCustId = $txn['customer_id'] ?? null;

            $user = $this->findUser($userId, $email);
            if ($user) {
                $user->update([
                    'plan'               => 'pro',
                    'paddle_customer_id' => $paddleCustId,
                    'pro_expires_at'     => now()->addYear(),
                ]);
                Log::info('PDFTash Pro activated via Paddle transaction for: ' . $user->email);
            }
        }

        return response('OK', 200);
    }

    public function success(Request $request)
    {
        // Webhook should have already upgraded the user.
        // Fallback: if not yet upgraded, mark as pro.
        if (Auth::check() && Auth::user()->plan !== 'pro') {
            Auth::user()->update(['plan' => 'pro', 'pro_expires_at' => now()->addYear()]);
            Log::info('Plan upgraded via success page fallback: ' . Auth::user()->email);
        }

        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }

    private function findUser($userId, $email)
    {
        $user = null;
        if ($userId) {
            $user = \App\Models\User::find($userId);
        }
        if (!$user && $email) {
            $user = \App\Models\User::where('email', $email)->first();
        }
        return $user;
    }
}
