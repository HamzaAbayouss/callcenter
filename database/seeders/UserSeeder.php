<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Hamza', 'email' => 'hamzaabayouss3@gmail.com', 'password' => bcrypt('12345678'), 'role' => 'admin', 'specialite_id' => 1],
            // ['name' => 'Mouad', 'email' => 'mouad@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 2],
            // ['name' => 'Sara', 'email' => 'sara@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            ['name' => 'Youssef', 'email' => 'youssef@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 1],
            // ['name' => 'Laila', 'email' => 'laila@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 2],
            // ['name' => 'Rachid', 'email' => 'rachid@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            // ['name' => 'Imane', 'email' => 'imane@test.com', 'password' => bcrypt('12345678'), 'role' => 'admin', 'specialite_id' => 1],
            // ['name' => 'Nadia', 'email' => 'nadia@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 2],
            // ['name' => 'Omar', 'email' => 'omar@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 1],
            // ['name' => 'Meriem', 'email' => 'meriem@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            // ['name' => 'Karim', 'email' => 'karim@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 2],
            // ['name' => 'Sofia', 'email' => 'sofia@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            // ['name' => 'Ahmed', 'email' => 'ahmed@test.com', 'password' => bcrypt('12345678'), 'role' => 'admin', 'specialite_id' => 1],
            // ['name' => 'Salma', 'email' => 'salma@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 2],
            // ['name' => 'Mounir', 'email' => 'mounir@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            // ['name' => 'Hiba', 'email' => 'hiba@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 1],
            // ['name' => 'Rania', 'email' => 'rania@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 2],
            // ['name' => 'Mehdi', 'email' => 'mehdi@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 1],
            // ['name' => 'Nour', 'email' => 'nour@test.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
            // ['name' => 'Sami', 'email' => 'sami@test.com', 'password' => bcrypt('12345678'), 'role' => 'technicien', 'specialite_id' => 2],
        ]);
    }
}
