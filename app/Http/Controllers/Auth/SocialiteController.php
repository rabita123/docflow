<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle(\Illuminate\Http\Request $request)
    {
        // If user clicked "Upgrade to Pro" while not logged in, send them to
        // pricing after login so they can complete checkout.
        if ($request->query('next') === 'pricing') {
            session(['url.intended' => '/#pricing']);
        }

        return Socialite::driver('google')
            ->with(['redirect_uri' => url('/auth/google/callback')])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->with(['redirect_uri' => url('/auth/google/callback')])
                ->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'      => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                    'password'  => bcrypt(\Illuminate\Support\Str::random(24)),
                    'plan'      => 'free',
                ]
            );

            Auth::login($user, true);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect('/')->with('error', 'Google login failed. Please try again.');
        }
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
