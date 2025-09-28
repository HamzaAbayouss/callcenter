<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert objets
        DB::table('objets')->insert([
            // Mobile
            ['reference' => 'OBJ001', 'titre' => 'Problème logiciel', 'specialite_id' => 1],
            ['reference' => 'OBJ005', 'titre' => 'Installation logiciel', 'specialite_id' => 1],
            ['reference' => 'OBJ009', 'titre' => 'Maintenance PC', 'specialite_id' => 1],
            ['reference' => 'OBJ013', 'titre' => 'Déploiement logiciel', 'specialite_id' => 1],
            ['reference' => 'OBJ016', 'titre' => 'Migration serveur', 'specialite_id' => 1],
            ['reference' => 'OBJ019', 'titre' => 'Installation périphérique', 'specialite_id' => 1],

            // Fixe
            ['reference' => 'OBJ002', 'titre' => 'Problème réseau', 'specialite_id' => 2],
            ['reference' => 'OBJ003', 'titre' => 'Problème de téléphonie', 'specialite_id' => 2],
            ['reference' => 'OBJ006', 'titre' => 'Câblage réseau', 'specialite_id' => 2],
            ['reference' => 'OBJ007', 'titre' => 'Configuration routeur', 'specialite_id' => 2],
            ['reference' => 'OBJ010', 'titre' => 'Problème internet', 'specialite_id' => 2],
            ['reference' => 'OBJ011', 'titre' => 'Téléphonie IP', 'specialite_id' => 2],
            ['reference' => 'OBJ014', 'titre' => 'Support réseau', 'specialite_id' => 2],
            ['reference' => 'OBJ017', 'titre' => 'Configuration VPN', 'specialite_id' => 2],
            ['reference' => 'OBJ020', 'titre' => 'Optimisation réseau', 'specialite_id' => 2],

            // Internet
            ['reference' => 'OBJ004', 'titre' => 'Support commercial', 'specialite_id' => 3],
            ['reference' => 'OBJ008', 'titre' => 'Formation client', 'specialite_id' => 3],
            ['reference' => 'OBJ012', 'titre' => 'Vente produit', 'specialite_id' => 3],
            ['reference' => 'OBJ015', 'titre' => 'Réclamation client', 'specialite_id' => 3],
            ['reference' => 'OBJ018', 'titre' => 'Suivi client', 'specialite_id' => 3],
        ]);
    }
}
