<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\UserCode;
use Carbon\Carbon;
use App\Mail\TwoFactorCodeMail;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Générer et envoyer un nouveau code par email directement ici
        $user = Auth::user();
        $code = rand(100000, 999999);
        $codeString = (string)$code;

        UserCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'code' => Hash::make($codeString),
                'expires_at' => now()->addMinutes(10)
            ]
        );

        $details = [
            'title' => 'Code de vérification - Fonds Tinga',
            'code' => $code
        ];
        
        Mail::to($user->email)->send(new TwoFactorCodeMail($details));
        
        return view('auth.two-factor-challenge');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();
    
        // Vérifier le code directement ici au lieu d'appeler une méthode sur le modèle User
        $userCode = UserCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if ($userCode) {
            $userCode->delete();
            $request->session()->put('auth.two_factor_confirmed', true);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['code' => 'Le code de vérification est invalide.']);
    }
    
    public function resend()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Générer et envoyer un nouveau code directement
        $user = Auth::user();
        $code = rand(100000, 999999);
        $codeString = (string)$code;

        UserCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'code' => Hash::make($codeString),
                'expires_at' => now()->addMinutes(10)
            ]
        );

        $details = [
            'title' => 'Code de vérification - Fonds Tinga',
            'code' => $code
        ];
        
        Mail::to($user->email)->send(new TwoFactorCodeMail($details));
        
        return back()->with('status', 'Un nouveau code de vérification a été envoyé à votre adresse email.');
    }
    
  
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);
        
        $user = Auth::user();
        $userCodes = UserCode::where('user_id', $user->id)
                           ->where('expires_at', '>', Carbon::now())
                           ->get();
        
        $validCode = false;
        foreach ($userCodes as $userCode) {
            if (Hash::check($request->code, $userCode->code)) {
                $validCode = true;
                $userCode->delete();
                break;
            }
        }
        
        if (!$validCode) {
            return back()->withErrors(['code' => 'Le code est invalide ou a expiré.']);
        }
        
        // Rediriger vers le dashboard
        return redirect()->route('dashboard');
    }
}