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
        DB::table('call_tickets')->insert([
            ['client' => 'Client A', 'objet_id' => 1, 'description' => 'Impossible de lancer le logiciel', 'status' => 'reçu'],
            ['client' => 'Client B', 'objet_id' => 2, 'description' => 'Pas de connexion réseau', 'status' => 'reçu'],
            ['client' => 'Client C', 'objet_id' => 3, 'description' => 'Problème de téléphone', 'status' => 'reçu'],
            ['client' => 'Client D', 'objet_id' => 4, 'description' => 'Besoin de support commercial', 'status' => 'reçu'],
            ['client' => 'Client E', 'objet_id' => 5, 'description' => 'Installation du logiciel échouée', 'status' => 'reçu'],
            ['client' => 'Client F', 'objet_id' => 6, 'description' => 'Câblage réseau incorrect', 'status' => 'reçu'],
            ['client' => 'Client G', 'objet_id' => 7, 'description' => 'Routeur non configuré', 'status' => 'reçu'],
            ['client' => 'Client H', 'objet_id' => 8, 'description' => 'Formation client nécessaire', 'status' => 'reçu'],
            ['client' => 'Client I', 'objet_id' => 9, 'description' => 'PC en panne', 'status' => 'reçu'],
            ['client' => 'Client J', 'objet_id' => 10, 'description' => 'Internet lent', 'status' => 'reçu'],
            ['client' => 'Client K', 'objet_id' => 11, 'description' => 'Téléphonie IP non fonctionnelle', 'status' => 'reçu'],
            ['client' => 'Client L', 'objet_id' => 12, 'description' => 'Demande de vente produit', 'status' => 'reçu'],
            ['client' => 'Client M', 'objet_id' => 13, 'description' => 'Déploiement logiciel', 'status' => 'reçu'],
            ['client' => 'Client N', 'objet_id' => 14, 'description' => 'Support réseau demandé', 'status' => 'reçu'],
            ['client' => 'Client O', 'objet_id' => 15, 'description' => 'Réclamation client', 'status' => 'reçu'],
            ['client' => 'Client P', 'objet_id' => 16, 'description' => 'Migration serveur', 'status' => 'reçu'],
            ['client' => 'Client Q', 'objet_id' => 17, 'description' => 'VPN non configuré', 'status' => 'reçu'],
            ['client' => 'Client R', 'objet_id' => 18, 'description' => 'Suivi client', 'status' => 'reçu'],
            ['client' => 'Client S', 'objet_id' => 19, 'description' => 'Installation périphérique', 'status' => 'reçu'],
            ['client' => 'Client T', 'objet_id' => 20, 'description' => 'Optimisation réseau', 'status' => 'reçu'],
        ]);
    }
}
