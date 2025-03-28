<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'abonne_id', 'numero', 'montant', 'type_souscription', 
        'date_debut', 'statut', 'commentaire'
    ];

    public function abonne()
    {
        return $this->belongsTo(Abonne::class);
    }
    
    // Méthode pour vérifier si la souscription peut être modifiée
    public function canBeEdited()
    {
        return $this->statut === 'en_attente';
    }
    
    // Méthode pour vérifier si la souscription est validée
    public function isValidated()
    {
        return $this->statut === 'validee';
    }
    
    // Méthode pour vérifier si la souscription est rejetée
    public function isRejected()
    {
        return $this->statut === 'rejetee';
    }
    
    // Méthode pour valider une souscription
    public function validate()
    {
        $this->statut = 'validee';
        return $this->save();
    }
    
    // Méthode pour rejeter une souscription
    public function reject()
    {
        $this->statut = 'rejetee';
        return $this->save();
    }

    // Méthode pour récupérer les souscriptions par région
    public static function getCountByRegion($region)
    {
        // Debug: Uncomment to check what's happening
        // \Log::info("Checking region: " . $region);
        
        $count = self::whereHas('abonne', function($query) use ($region) {
            $query->where(function($q) use ($region) {
                $q->where('ville', 'like', '%' . $region . '%')
                  ->orWhere('region', 'like', '%' . $region . '%')
                  ->orWhere('region', $region);
            });
        })->count();
        
        // Debug: Uncomment to check counts
        // \Log::info("Count for {$region}: {$count}");
        
        return $count;
    }
    
}
