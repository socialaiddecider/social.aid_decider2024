<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Note: This is a migration file for creating table penilaian

        // Create table penilaian
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif');
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriteria');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop table penilaian
        Schema::dropIfExists('penilaian');
    }
};
//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024