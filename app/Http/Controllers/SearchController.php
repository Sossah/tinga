<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        // $clients = Client::where('name', 'like', "%{$query}%")->get();
        
        return view('search.results', compact('query', 'users'));
    }
}
