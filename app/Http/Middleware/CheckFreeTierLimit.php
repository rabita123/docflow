<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CheckFreeTierLimit
{
    // Free tier limits
    const FREE_DAILY_LIMIT = 5;

    public function handle(Request $request, Closure $next)
    {
        // Skip for AI routes — they have their own limit
        // Skip if user is Pro (future: check subscription)
        
        $ip  = $request->ip();
        $key = 'free_limit_' . $ip . '_' . date('Y-m-d');
        $count = Cache::get($key, 0);

        if ($count >= self::FREE_DAILY_LIMIT) {
            return response()->json([
                'error'   => 'free_limit_reached',
                'message' => 'You have used your 5 free tasks today. Upgrade to Pro for unlimited access.',
                'limit'   => self::FREE_DAILY_LIMIT,
                'used'    => $count,
            ], 429);
        }

        // Increment counter
        Cache::put($key, $count + 1, now()->endOfDay());

        return $next($request);
    }
}