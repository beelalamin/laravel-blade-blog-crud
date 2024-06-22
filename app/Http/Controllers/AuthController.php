<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        // Validate
        $credentials =  $request->validate([
            'username' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'confirmed', 'min:3'],
        ]);

        // Register
        $user = User::create($credentials);

        // Login
        Auth::login($user);

        // Redirect
        return redirect('/');
    }


    public function login(Request $request)
    {

        // Validate
        $credentials =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login
        $login = Auth::attempt($credentials, $request->remember);

        // Redirect
        if ($login) {
            return redirect()->intended();
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
}
