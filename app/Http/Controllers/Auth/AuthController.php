<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Read intended URL before login — Auth::login() regenerates the session
        // which can clear session data in some Laravel versions.
        $intended = $request->session()->pull('url.intended', '/dashboard');

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'], // 'hashed' cast in User model handles hashing
            'plan'     => 'free',
        ]);

        Auth::login($user, true);

        return response()->json([
            'success'  => true,
            'redirect' => $intended,
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Read intended URL before attempt — session regenerates on login
        $intended = $request->session()->pull('url.intended', '/dashboard');

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect email or password.',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'success'  => true,
            'redirect' => $intended,
        ]);
    }
}
