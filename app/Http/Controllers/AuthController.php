<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        // Validate
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'confirmed', 'min:3'],
        ]);

        // Register
        $user = User::create($credentials);

        // Login
        Auth::login($user);

        // Invoke for email verification
        event(new Registered($user));

        // Redirect
        return redirect()->route('dashboard');
    }


    public function login(Request $request)
    {

        // Validate
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login
        $login = Auth::attempt($credentials, $request->remember);

        // Redirect
        if ($login) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'Credentials does not match our record!'
            ]);
        }
    }

    public function logout(Request $request)
    {


        // logout user
        Auth::logout();

        // invalidate the current session
        $request->session()->invalidate('dashboard');

        // regenerate the token
        $request->session()->regenerateToken();

        // redirect to home
        return redirect()->route('login');
    }

    // Email Verification Notice
    public function verificationNotice()
    {
        return view('auth.verify-email');
    }

    // Verify the email
    public function verificationHandler(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('dashboard');
    }

    // Resend verification email
    public function ResendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
