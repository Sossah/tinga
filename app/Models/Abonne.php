<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'email', 'telephone', 'adresse', 'ville', 
        'region', 'profession', 'date_naissance', 'sexe', 'numero_piece', 'type_piece'
    ];

    public function souscriptions()
    {
        return $this->hasMany(Souscription::class);
    }
    
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
