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
        //Note: This is a migration file for creating table algoritma_genetika

        // Create table algoritma_genetika
        Schema::create('algoritma_genetika', function (Blueprint $table) {
            $table->id('id');
            $table->integer('iterasi');
            $table->integer('popsize');
            $table->double('cr');
            $table->double('mr');
            $table->integer('jumlah_penerima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop table algoritma_genetika
        Schema::dropIfExists('algoritma_genetika');
    }
};

//Note: This file is created by Thoriq Fathurrozi
//Note: This file is created on May 24, 2024