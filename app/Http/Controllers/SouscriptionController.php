<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\Souscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SouscriptionController extends Controller
{
    public function index()
    {
        $souscriptions = Souscription::with('abonne')->latest()->get();
        return view('souscriptions.index', compact('souscriptions'));
    }
    
    public function create()
    {
        return view('souscriptions.create_step1');
    }
    
    public function storeStep1(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:abonnes,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'region' => 'required|string|max:100', // Changé de 'regions' à 'region' pour correspondre au formulaire
            'profession' => 'required|string|max:100',
            'date_naissance' => 'required|date',
            'sexe' => 'required|in:M,F',
            'numero_piece' => 'required|string|max:50',
            'type_piece' => 'required|string|max:50',
        ]);
        
        // Stocker les données dans la session
        Session::put('abonne_data', $validatedData);
        
        return redirect()->route('souscriptions.create.step2');
    }
    
    public function createStep2()
    {
        // Vérifier si les données de l'abonné existent dans la session
        if (!Session::has('abonne_data')) {
            return redirect()->route('souscriptions.create')->with('error', 'Veuillez d\'abord remplir les informations de l\'abonné');
        }
        
        return view('souscriptions.create_step2');
    }
    
    public function storeStep2(Request $request)
    {
        // Vérifier si les données de l'abonné existent dans la session
        if (!Session::has('abonne_data')) {
            return redirect()->route('souscriptions.create')->with('error', 'Veuillez d\'abord remplir les informations de l\'abonné');
        }
        
        $validatedData = $request->validate([
            'montant' => 'required|numeric|min:1',
            'amperes' => 'nullable|string|max:50', // Ajout du champ amperes
            'type_souscription' => 'required|string|max:100',
            'commentaire' => 'nullable|string',
        ]);
        
        // Récupérer les données de l'abonné depuis la session
        $abonneData = Session::get('abonne_data');
        
        // Utiliser une transaction pour s'assurer que tout est enregistré correctement
        DB::beginTransaction();
        
        // Dans la méthode storeStep2, modifiez la création de la souscription
        try {
            // Créer l'abonné
            $abonne = Abonne::create($abonneData);
            
            // Créer la souscription
            $souscription = new Souscription($validatedData);
            $souscription->abonne_id = $abonne->id;
            $souscription->numero = 'TINGA-' . date('YmdHis') . '-' . rand(1000, 9999);
            $souscription->statut = 'en_attente';
            $souscription->date_debut = now(); // Ajoutez cette ligne pour définir la date de début
            $souscription->save();
            
            // Tout s'est bien passé, on valide la transaction
            DB::commit();
            
            // Supprimer les données de session
            Session::forget('abonne_data');
            
            return redirect()->route('souscriptions.confirmation', $souscription->id);
        } catch (\Exception $e) {
            // En cas d'erreur, on annule la transaction
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement: ' . $e->getMessage());
        }
    }
    
    public function confirmation($id)
    {
        $souscription = Souscription::with('abonne')->findOrFail($id);
        return view('souscriptions.confirmation', compact('souscription'));
    }
    
    public function show($id)
    {
        $souscription = Souscription::with('abonne')->findOrFail($id);
        return view('souscriptions.show', compact('souscription'));
    }
    
    public function edit($id)
    {
        $souscription = Souscription::with('abonne')->findOrFail($id);
        return view('souscriptions.edit', compact('souscription'));
    }
    
    public function update(Request $request, $id)
    {
        $souscription = Souscription::findOrFail($id);
        
        $validatedData = $request->validate([
            'statut' => 'required|in:en_attente,validee,rejetee',
            'montant' => 'required|numeric|min:1',
            'amperes' => 'nullable|string|max:50', // Ajout du champ amperes
            'type_souscription' => 'required|string|max:100',
            'commentaire' => 'nullable|string',
        ]);
        
        // Update subscriber information if provided
        if ($request->has('abonne')) {
            $abonneData = $request->validate([
                'abonne.nom' => 'required|string|max:255',
                'abonne.prenom' => 'required|string|max:255',
                'abonne.email' => 'nullable|email|unique:abonnes,email,' . $souscription->abonne_id,
                'abonne.telephone' => 'required|string|max:20',
                'abonne.adresse' => 'required|string|max:255',
                'abonne.ville' => 'required|string|max:100',
                'abonne.region' => 'required|string|max:100',
                'abonne.profession' => 'required|string|max:100',
                'abonne.date_naissance' => 'required|date',
                'abonne.sexe' => 'required|in:M,F',
                'abonne.numero_piece' => 'required|string|max:50',
                'abonne.type_piece' => 'required|string|max:50',
            ]);
            
            $souscription->abonne->update($abonneData['abonne']);
        }
        
        $souscription->update($validatedData);
        
        return redirect()->route('souscriptions.show', $souscription->id)
            ->with('success', 'Souscription mise à jour avec succès');
    }
    
    /**
     * Supprimer une souscription
     */
    public function destroy($id)
    {
        $souscription = Souscription::findOrFail($id);
        
        // Utiliser une transaction pour s'assurer que tout est supprimé correctement
        DB::beginTransaction();
        
        try {
            // Récupérer l'ID de l'abonné avant de supprimer la souscription
            $abonneId = $souscription->abonne_id;
            
            // Supprimer la souscription
            $souscription->delete();
            
            // Vérifier si l'abonné a d'autres souscriptions
            $autresSouscriptions = Souscription::where('abonne_id', $abonneId)->count();
            
            // Si l'abonné n'a plus de souscriptions, le supprimer également
            if ($autresSouscriptions == 0) {
                Abonne::destroy($abonneId);
            }
            
            DB::commit();
            
            return redirect()->route('souscriptions.index')
                ->with('success', 'Souscription supprimée avec succès');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('souscriptions.index')
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
    
    /**
     * Valider une souscription
     */
    public function validateSouscription($id)
    {
        $souscription = Souscription::findOrFail($id);
        
        if (!$souscription->canBeEdited()) {
            return redirect()->route('souscriptions.index')
                ->with('error', 'Cette souscription ne peut pas être validée car elle a déjà été traitée.');
        }
        
        $souscription->validate();
        
        return redirect()->route('souscriptions.index')
            ->with('success', 'Souscription validée avec succès.');
    }
    
    /**
     * Rejeter une souscription
     */
    public function rejectSouscription($id)
    {
        $souscription = Souscription::findOrFail($id);
        
        if (!$souscription->canBeEdited()) {
            return redirect()->route('souscriptions.index')
                ->with('error', 'Cette souscription ne peut pas être rejetée car elle a déjà été traitée.');
        }
        
        $souscription->reject();
        
        return redirect()->route('souscriptions.index')
            ->with('success', 'Souscription rejetée avec succès.');
    }
}
