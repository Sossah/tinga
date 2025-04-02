<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Souscription;

// Importez d'autres modèles selon vos besoins de recherche

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        // Exemple de recherche dans plusieurs modèles
        $users = User::where('name', 'like', "%{$query}%")
                     ->orWhere('email', 'like', "%{$query}%")
                     ->get();
        
        // Ajoutez d'autres recherches selon vos besoins

        $souscriptions = Souscription::where('numero', 'like', "%{$query}%")
                                       ->get();

        $abonne=Abonne::where('nom', 'like', "%{$query}%")
                                       ->orWhere('email', 'like', "%{$query}%")
                                       ->orWhere('prenom', 'like', "%{$query}%")
                                       ->orWhere('telephone', 'like', "%{$query}%")
                                       ->get();
        
        return view('search.results', compact('query', 'users','souscriptions','abonne'));
    }
}
