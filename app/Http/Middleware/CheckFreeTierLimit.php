<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Access control:
 *  - PDF tools  (/api/pdf/*)  → completely free, no limits, no login required
 *  - AI tools   (/api/ai/*)   → Pro plan required (paid users only)
 */
class CheckFreeTierLimit
{
    // Kept for backward-compat with /api/usage endpoint — not used for enforcement
    const LIMITS = ['pdf' => 999, 'ai' => 0];

    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        // PDF tools — always free, pass through immediately
        if (str_contains($path, 'api/pdf')) {
            return $next($request);
        }

        // AI tools — require active Pro subscription
        if (str_contains($path, 'api/ai')) {
            if (Auth::check() && Auth::user()->plan === 'pro') {
                return $next($request);
            }

            return response()->json([
                'error'   => 'pro_required',
                'message' => 'This AI feature requires a Pro plan. Upgrade to unlock unlimited AI tools.',
            ], 402);
        }

        // All other routes — pass through
        return $next($request);
    }
}
