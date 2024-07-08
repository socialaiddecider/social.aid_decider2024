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
        //Note: This is a migration file for creating table kriteria, subkriteria, and bobot
        //Note: This migration file create table that have relation to the kriteria


        // Create table kriteria
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('id');
            $table->string('kode_kriteria', 50);
            $table->string('nama', 100);
            $table->string('jenis', 100);
            $table->double('bobot')->nullable();
            $table->timestamps();
        });

        // Create table subkriteria
        Schema::create('subkriteria', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->string('nama', 100);
            $table->integer('nilai');
            $table->timestamps();
        });

        // Create table bobot
        Schema::create('bobot', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->double('bobot');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop table kriteria, subkriteria, and bobot
        Schema::dropIfExists('kriteria');
        Schema::dropIfExists('subkriteria');
        Schema::dropIfExists('bobot');
    }
};


//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024