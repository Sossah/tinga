<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use App\Models\UserCode;
use Exception;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, TwoFactorAuthenticatable;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',   
        'address', 
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtenir les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
  
    
    /**
     * Générer et envoyer un code d'authentification à deux facteurs par email
     *
     * @return void
     */
    public function generateAndSendTwoFactorCode()
    {
        $code = rand(100000, 999999);

        try {
            UserCode::updateOrCreate(
                ['user_id' => $this->id],
                [
                    'code' => $code,
                    'expires_at' => now()->addMinutes(10)
                ]
            );

            $details = [
                'title' => 'Code de vérification - Fonds Tinga',
                'code' => $code
            ];
            
            Mail::to($this->email)->send(new TwoFactorCodeMail($details));
            
            return true;
        } catch (Exception $e) {
            Log::error('Erreur d\'authentification à deux facteurs: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Vérifier le code d'authentification à deux facteurs
     *
     * @param string $code
     * @return bool
     */
    public function verifyTwoFactorCode($code)
    {
        try {
            $userCode = UserCode::where('user_id', $this->id)
                ->where('code', $code)
                ->where('expires_at', '>', now())
                ->first();

            if ($userCode) {
                $userCode->delete();
                return true;
            }
            
            return false;
        } catch (Exception $e) {
            Log::error('Erreur de vérification du code: ' . $e->getMessage());
            return false;
        }
    }
}
