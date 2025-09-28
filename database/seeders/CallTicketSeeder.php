<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            ['client' => 'Client A', 'objet_id' => 1, 'description' => 'Impossible de lancer le logiciel', 'status' => 'terminé'],
            ['client' => 'Client B', 'objet_id' => 2, 'description' => 'Pas de connexion réseau', 'status' => 'terminé'],
            ['client' => 'Client C', 'objet_id' => 3, 'description' => 'Problème de téléphone', 'status' => 'terminé'],
            ['client' => 'Client D', 'objet_id' => 4, 'description' => 'Besoin de support commercial', 'status' => 'terminé'],
            ['client' => 'Client E', 'objet_id' => 5, 'description' => 'Installation du logiciel échouée', 'status' => 'terminé'],
            ['client' => 'Client F', 'objet_id' => 6, 'description' => 'Câblage réseau incorrect', 'status' => 'terminé'],
            ['client' => 'Client G', 'objet_id' => 7, 'description' => 'Routeur non configuré', 'status' => 'terminé'],
            ['client' => 'Client H', 'objet_id' => 8, 'description' => 'Formation client nécessaire', 'status' => 'terminé'],
            ['client' => 'Client I', 'objet_id' => 9, 'description' => 'PC en panne', 'status' => 'terminé'],
            ['client' => 'Client J', 'objet_id' => 10, 'description' => 'Internet lent', 'status' => 'terminé'],
            ['client' => 'Client K', 'objet_id' => 11, 'description' => 'Téléphonie IP non fonctionnelle', 'status' => 'terminé'],
            ['client' => 'Client L', 'objet_id' => 12, 'description' => 'Demande de vente produit', 'status' => 'terminé'],
            ['client' => 'Client M', 'objet_id' => 13, 'description' => 'Déploiement logiciel', 'status' => 'terminé'],
            ['client' => 'Client N', 'objet_id' => 14, 'description' => 'Support réseau demandé', 'status' => 'terminé'],
            ['client' => 'Client O', 'objet_id' => 15, 'description' => 'Réclamation client', 'status' => 'terminé'],
            ['client' => 'Client P', 'objet_id' => 16, 'description' => 'Migration serveur', 'status' => 'terminé'],
            ['client' => 'Client Q', 'objet_id' => 17, 'description' => 'VPN non configuré', 'status' => 'terminé'],
            ['client' => 'Client R', 'objet_id' => 18, 'description' => 'Suivi client', 'status' => 'terminé'],
            ['client' => 'Client S', 'objet_id' => 19, 'description' => 'Installation périphérique', 'status' => 'terminé'],
            ['client' => 'Client T', 'objet_id' => 20, 'description' => 'Optimisation réseau', 'status' => 'terminé'],
        ];

        // Ajouter user_id aléatoire
        foreach ($tickets as &$ticket) {
            $ticket['user_id'] = rand(1, 3); // user_id = 1, 2 ou 3
        }

        // Inserer dans la table
        DB::table('call_tickets')->insert($tickets);
    }
}
