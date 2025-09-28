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
            ['name' => 'Administrateur', 'email' => 'admin@example.com', 'password' => bcrypt('12345678'), 'role' => 'admin', 'specialite_id' => null],
            ['name' => 'Commercial Mobile', 'email' => 'commercial.mobile@example.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 1],
            ['name' => 'Commercial Fixe', 'email' => 'commercial.fixe@example.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 2],
            ['name' => 'Commercial Internet', 'email' => 'commercial.internet@example.com', 'password' => bcrypt('12345678'), 'role' => 'commercial', 'specialite_id' => 3],
        ]);
    }
}
