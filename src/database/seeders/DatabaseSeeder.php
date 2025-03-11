<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StaffSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            StaffSeeder::class,
            UserSeeder::class,
        ]);
    }
}
