<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Note: This is a seeder file for seeding user table

        // create user
        User::factory()->create([
            'name' => 'Thoriq Fathurrozi',
            'username' => 'thoriq',
            'email' => 'thoriqfathurrozi@gmail.com'
        ]);
        // send info to console
        $this->command->info('User table seeded!');

    }
}
//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024