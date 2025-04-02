<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Souscription;
use App\Models\Abonne;
use Carbon\Carbon;
use Faker\Factory as Faker;

class SouscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        
        // Créer 50 abonnés
        $abonnes = [];
        for ($i = 0; $i < 50; $i++) {
            $abonne = Abonne::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'date_naissance' => $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
                'sexe' => $faker->randomElement(['M', 'F']),
                'profession' => $faker->jobTitle,
                'telephone' => $faker->unique()->phoneNumber,
                'email' => $faker->unique()->email,
                'region' => $faker->randomElement(['Maritime', 'Plateaux', 'Centrale', 'Kara', 'Savane']),
                'ville' => $faker->city,
                'adresse' => $faker->address,
                'type_piece' => $faker->randomElement(['CNI', 'Passeport', 'Permis','carte_electeur']),
                'numero_piece' => $faker->unique()->numerify('ID########'),
            ]);
            
            $abonnes[] = $abonne;
        }
        
        // Statuts possibles
        $statuts = ['validee', 'en_attente', 'rejetee'];
        
        // Créer une souscription pour chaque abonné
        foreach ($abonnes as $index => $abonne) {
            // Générer une date aléatoire dans les 6 derniers mois
            $date = Carbon::now()->subDays(rand(1, 180));
            
            // Type de souscription (4 ans ou 10 ans)
            $type_souscription = $faker->randomElement(['2_fils', '4_fils']);
            $amperes= $faker->randomElement([5, 60]);
            
            Souscription::create([
                'numero' => 'TINGA-' . date('YmdHis') . '-' . rand(1000, 9999),
                'abonne_id' => $abonne->id,
                'statut' => $faker->randomElement($statuts),
                'type_souscription' => $type_souscription,
                'amperes' => $amperes,
                'montant' => 1000, // Montant par défaut fixé à 1000
                'date_debut' => $date->copy()->addDays(rand(5, 15))->format('Y-m-d'), // Date de début après la création
                'commentaire' => $faker->paragraph,
                'created_at' => $date,
                'updated_at' => $date->copy()->addDays(rand(0, 5)),
            ]);
        }
    }
}
