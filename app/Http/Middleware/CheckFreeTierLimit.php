<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckFreeTierLimit
{
    // Daily limits per tool group for free users
    const LIMITS = [
        'pdf'  => 3,   // compress, merge, split, sign, etc.
        'ai'   => 1,   // chat, translate, summarize
    ];

    public function handle(Request $request, Closure $next)
    {
        // Pro users — unlimited
        if (Auth::check() && Auth::user()->plan === 'pro') {
            return $next($request);
        }

        // Determine tool group from route
        $path  = $request->path(); // e.g. api/pdf/compress or api/ai/translate
        $group = $this->getGroup($path);

        if (!$group) {
            return $next($request); // unknown route — skip
        }

        $limit      = self::LIMITS[$group];
        $identifier = Auth::check() ? 'user_' . Auth::id() : 'ip_' . $request->ip();
        $today      = date('Y-m-d');
        $key        = "limit_{$group}_{$identifier}_{$today}";
        $used       = Cache::get($key, 0);

        if ($used >= $limit) {
            $groupLabel = $group === 'pdf' ? 'PDF tool' : 'AI tool';
            return response()->json([
                'error'     => 'free_limit_reached',
                'message'   => "You've used your {$limit} free {$groupLabel} tasks for today. Upgrade to Pro for unlimited access.",
                'group'     => $group,
                'limit'     => $limit,
                'used'      => $used,
                'remaining' => 0,
            ], 429);
        }

        // Increment daily counter — expires at end of day
        Cache::put($key, $used + 1, now()->endOfDay());

        $response = $next($request);
        $response->headers->set('X-Tasks-Used',      $used + 1);
        $response->headers->set('X-Tasks-Remaining', $limit - ($used + 1));
        $response->headers->set('X-Tasks-Limit',     $limit);
        $response->headers->set('X-Tasks-Group',     $group);

        return $response;
    }

    private function getGroup(string $path): ?string
    {
        if (str_contains($path, 'api/pdf') || str_contains($path, 'api/pdf')) return 'pdf';
        if (str_contains($path, 'api/ai'))  return 'ai';
        return null;
    }
}
