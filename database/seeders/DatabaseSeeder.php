<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Note: This is a main seeder file for seeding database and this file is run when call db:seed command

        // call class seeder
        $this->call([
            UserSeeder::class,
            SQLSeeder::class,
        ]);

    }
}
//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024
