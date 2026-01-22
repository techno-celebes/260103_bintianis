<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            
            // Redirect ke dashboard jika user adalah admin, selain itu ke home
            $user = Auth::user();
            if ($user && $user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/home');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
}
