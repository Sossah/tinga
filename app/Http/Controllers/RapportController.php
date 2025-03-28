<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Souscription;
use Carbon\Carbon; // Ajout de l'import Carbon

class RapportController extends Controller
{
    public function index()
    {
        return view('admin.rapports');
    }
    
    public function souscriptions(Request $request)
    {
        $query = Souscription::with('abonne');
        
        // Filtrer par période
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'mois':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'trimestre':
                    $query->where('created_at', '>=', now()->startOfQuarter())
                          ->where('created_at', '<=', now()->endOfQuarter());
                    break;
                case 'annee':
                    $query->whereYear('created_at', now()->year);
                    break;
                // Pour 'personnalise', vous pourriez ajouter des champs de date supplémentaires
            }
        }
        
        // Filtrer par région
        if ($request->filled('region')) {
            $query->whereHas('abonne', function($q) use ($request) {
                $q->where('region', $request->region);
            });
        }
        
        // Filtrer par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        
        // Dans la méthode souscriptions
        if ($request->periode == 'personnalise' && $request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->date_debut)->startOfDay(),
                Carbon::parse($request->date_fin)->endOfDay()
            ]);
        }
        
        $souscriptions = $query->latest()->get();
        
        return view('admin.rapports.souscriptions', compact('souscriptions'));
    }
    
    public function financiers()
    {
        // Vous pourriez ajouter ici la logique pour récupérer les données réelles
        return view('admin.rapports.financiers');
    }
}