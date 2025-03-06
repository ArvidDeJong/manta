<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = DB::table('staff')->where('email', 'demo@manta.website')->exists();

        if (!$exists) {
            // Voeg het record toe als het niet bestaat
            DB::table('staff')->insert([
                'name' => 'Beheer',
                'email' => 'demo@manta.website',
                'password' => Hash::make('Ihitro2024!')
            ]);
            echo "Nieuw staff lid toegevoegd.";
        } else {
            echo "Staff lid bestaat al.";
        }
    }
}
