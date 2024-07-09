<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class JSONSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = [
            'berita' => 'database/seeders/JSON/berita_seeds.json',
        ];

        foreach ($path as $table => $path) {
            // truncate the table
            DB::table($table)->truncate();
            // run the JSON file
            $data = File::get($path);
            $data = json_decode($data, true);
            DB::table($table)->insert($data);
            // send info to console
            $this->command->info($table . ' table seeded!');
        }
    }
}
