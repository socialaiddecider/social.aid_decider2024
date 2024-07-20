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

        $userData = [
            [
                'name' => 'Thoriq Fathurrozi',
                'username' => 'thoriq',
                'email' => 'thoriqfathurrozi@gmail.com',
                'url_image' => 'https://images.pexels.com/photos/15286/pexels-photo.jpg',
            ],
            [
                'name' => 'Ifa Indrian Ningsih',
                'username' => 'indrian',
                'email' => 'ifaindrian152@gmail.com',
                'url_image' => 'https://images.pexels.com/photos/15286/pexels-photo.jpg',
            ],
            [
                'name' => 'Niken Maharani Permata',
                'username' => 'maharani',
                'email' => 'nikenmaharanipersonal@gmail.com',
                'url_image' => 'https://images.pexels.com/photos/15286/pexels-photo.jpg',
            ],
            [
                'name' => 'Muhammad Al Kindy',
                'username' => 'muhammad',
                'email' => 'al.kindy0000@gmail.com',
                'url_image' => 'https://images.pexels.com/photos/15286/pexels-photo.jpg',
            ],
            [
                'name' => 'Moch. Naufal A. R.',
                'username' => 'naufal',
                'email' => 'naufalportofolio12@gmail.com',
                'url_image' => 'https://images.pexels.com/photos/15286/pexels-photo.jpg',
            ],
        ];

        // create user
        foreach ($userData as $data) {
            User::factory()->create($data);
        }

        // send info to console
        $this->command->info('User table seeded!');

    }
}
//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024