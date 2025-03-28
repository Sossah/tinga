<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil mis à jour avec succès!');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validated = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
            'password' => ['required', 'string', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers(), 
                'confirmed'],
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Mot de passe mis à jour avec succès!');
    }
}