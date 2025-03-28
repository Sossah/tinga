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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard'); // Redirection après connexion
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
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
