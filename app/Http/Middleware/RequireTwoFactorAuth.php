<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequireTwoFactorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        // Si l'utilisateur est authentifié mais n'a pas encore validé le code 2FA
        if ($user && !$request->session()->has('auth.two_factor_confirmed')) {
            return redirect()->route('two-factor.challenge');
        }
        
        return $next($request);
    }
}