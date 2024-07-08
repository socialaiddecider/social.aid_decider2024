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

        //Note: This is a migration file for creating table alternatif, data_asli, jumlah_kali, kali_pangkat, hasil_spk, and penerima
        //Note: This migration file create table that have relation to the alternatif

        // Create table alternatif
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id('id');
            $table->string('kode_alternatif', 50);
            $table->string('nama', 100);
            $table->string('nik', 100);
            $table->string('alamat', 100);
            $table->timestamps();
        });

        Schema::create('data_asli', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
            $table->string('status', 100);
            $table->timestamps();
        });

        Schema::create('jumlah_kali', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
            $table->double('nilai');
            $table->timestamps();
        });

        Schema::create('kali_pangkat', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
            $table->double('nilai');
            $table->timestamps();
        });

        Schema::create('hasil_spk', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
            $table->double('nilai');
            $table->timestamps();
        });

        Schema::create('penerima', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatif')->onDelete('cascade');
            $table->double('nilai');
            $table->string('status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop table alternatif, data_asli, jumlah_kali, kali_pangkat, hasil_spk, and penerima
        Schema::dropIfExists('alternatif');
        Schema::dropIfExists('data_asli');
        Schema::dropIfExists('jumlah_kali');
        Schema::dropIfExists('kali_pangkat');
        Schema::dropIfExists('hasil_spk');
        Schema::dropIfExists('penerima');
    }
};

//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024