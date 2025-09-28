<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialites')->insert([
            ['nom' => 'Mobile'],
            ['nom' => 'Fixe'],
            ['nom' => 'Internet'],
        ]);
    }
}
