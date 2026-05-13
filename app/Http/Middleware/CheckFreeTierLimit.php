<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckFreeTierLimit
{
    const FREE_TOTAL_LIMIT = 150;

    public function handle(Request $request, Closure $next)
    {
        // Pro users — unlimited
        if (Auth::check() && Auth::user()->plan === 'pro') {
            return $next($request);
        }

        // Identify user: logged in → user ID, guest → IP
        $identifier = Auth::check() ? 'user_' . Auth::id() : 'ip_' . $request->ip();
        $key        = 'tasks_used_' . $identifier;
        $used       = Cache::get($key, 0);

        if ($used >= self::FREE_TOTAL_LIMIT) {
            return response()->json([
                'error'     => 'free_limit_reached',
                'message'   => 'You have used all 150 free tasks. Upgrade to Pro for unlimited access.',
                'limit'     => self::FREE_TOTAL_LIMIT,
                'used'      => $used,
                'remaining' => 0,
            ], 429);
        }

        // Increment — store for 365 days (permanent free quota)
        Cache::put($key, $used + 1, now()->addDays(365));

        // Attach remaining to response header
        $response = $next($request);
        $response->headers->set('X-Tasks-Used',      $used + 1);
        $response->headers->set('X-Tasks-Remaining', self::FREE_TOTAL_LIMIT - ($used + 1));
        $response->headers->set('X-Tasks-Limit',     self::FREE_TOTAL_LIMIT);

        return $response;
    }
}
