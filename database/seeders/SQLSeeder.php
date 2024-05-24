<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SQLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: This is a seeder file for seeding database with SQL file

        // paths of SQL files in database/seeders/SQL with table name
        $paths = [
            'algoritma_genetika' => 'database/seeders/SQL/algoritma_genetika_seeds.sql',
            'kriteria' => 'database/seeders/SQL/kriteria_seeds.sql',
            'bobot' => 'database/seeders/SQL/bobot_seeds.sql',
            'subkriteria' => 'database/seeders/SQL/subkriteria_seeds.sql',
            'alternatif' => 'database/seeders/SQL/alternatif_seeds.sql',
            'hasil_spk' => 'database/seeders/SQL/hasil_spk_seeds.sql',
            'data_asli' => 'database/seeders/SQL/data_asli_seeds.sql',
            'jumlah_kali' => 'database/seeders/SQL/jumlah_kali_seeds.sql',
            'kali_pangkat' => 'database/seeders/SQL/kali_pangkat_seeds.sql',
            'penerima' => 'database/seeders/SQL/penerima_seeds.sql',
            'normalisasi' => 'database/seeders/SQL/normalisasi_seeds.sql',
            'penilaian' => 'database/seeders/SQL/penilaian_seeds.sql',
        ];

        // loop through paths and seed the database
        foreach ($paths as $table => $path) {
            // unguard the model
            Eloquent::unguard();
            // run the SQL file
            DB::unprepared(file_get_contents($path));
            // send info to console
            $this->command->info($table . ' table seeded!');
        }
    }
}
//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024