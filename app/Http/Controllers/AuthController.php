<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Rediriger vers la vérification 2FA au lieu du dashboard
            return redirect()->route('two-factor.challenge');
        }
        
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return route('dashboard');
    }
}
