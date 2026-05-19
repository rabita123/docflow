<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Blocks API calls that don't originate from pdftash.com itself.
 * Prevents other websites from abusing your Anthropic API key
 * by calling /api/ai/* from their own frontend.
 */
class GuardApiOrigin
{
    // Allowed origins — add localhost for local dev
    private const ALLOWED = [
        'https://pdftash.com',
        'https://www.pdftash.com',
        'http://localhost',
        'http://localhost:8000',
        'http://127.0.0.1',
        'http://127.0.0.1:8000',
    ];

    public function handle(Request $request, Closure $next)
    {
        // Skip check in local/testing environments
        if (app()->environment(['local', 'testing'])) {
            return $next($request);
        }

        $origin  = $request->header('Origin', '');
        $referer = $request->header('Referer', '');

        // Accept if Origin matches
        foreach (self::ALLOWED as $allowed) {
            if (str_starts_with($origin, $allowed) || str_starts_with($referer, $allowed)) {
                return $next($request);
            }
        }

        // No valid origin — block
        return response()->json([
            'error' => 'Unauthorized origin. API access is restricted to pdftash.com.',
        ], 403);
    }
}
