<?php

namespace App\Http\Controllers;

use App\Models\Souscription;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer le nombre total d'utilisateurs
        $totalUsers = User::count();
        $totalSouscriptions = Souscription::count();
        $souscriptionsEnAttente = Souscription::where('statut', 'en_attente')->count();

        // Récupérer le nombre d'utilisateurs avec le rôle "Agent"
        $agentRole = Role::where('name', 'Agent')->first();
        $totalAgents = 0;

        if ($agentRole) {
            $totalAgents = $agentRole->users()->count();
        }

        // Calcul des revenus mensuels (somme des montants des souscriptions du mois en cours)
        $revenuMensuel = Souscription::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->where('statut', 'validee')->sum('montant');

        // Calcul des revenus du mois précédent
        $revenuMoisPrecedent = Souscription::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->where('statut', 'validee')
            ->sum('montant');

        // Calcul du pourcentage d'augmentation
        $pourcentageRevenu = 0;
        if ($revenuMoisPrecedent > 0) {
            $pourcentageRevenu = round((($revenuMensuel - $revenuMoisPrecedent) / $revenuMoisPrecedent) * 100);
        }

        // Préparation des données pour le graphique d'évolution des souscriptions
        $moisLabels = [];
        $souscriptionsParMois = [];

        // Récupérer les données des 6 derniers mois
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $mois = $date->format('M');
            $annee = $date->format('Y');

            $moisLabels[] = $mois . ' ' . $annee;

            $count = Souscription::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count();

            $souscriptionsParMois[] = $count;
        }

        // Préparation des données pour le graphique de répartition par régions
        $regionsLabels = ['Maritime', 'Plateaux', 'Centrale', 'Kara', 'Savane'];
        $souscriptionsParRegion = [];
        $regionsAvecSouscriptions = [];

        foreach ($regionsLabels as $region) {
            $count = Souscription::getCountByRegion($region);
            
            // N'ajouter que les régions avec des souscriptions
            if ($count > 0) {
                $regionsAvecSouscriptions[] = $region;
                $souscriptionsParRegion[] = $count;
            }
        }
        
        // Remplacer les labels originaux par ceux qui ont des souscriptions
        $regionsLabels = $regionsAvecSouscriptions;
        return view('admin.dashboard', compact('totalUsers', 'totalAgents', 'totalSouscriptions', 'souscriptionsEnAttente', 'revenuMensuel', 'pourcentageRevenu', 'moisLabels', 'souscriptionsParMois', 'regionsLabels', 'souscriptionsParRegion'));
    }
}
