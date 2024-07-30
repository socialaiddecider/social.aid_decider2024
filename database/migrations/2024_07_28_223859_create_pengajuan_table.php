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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('periode');
            $table->timestamps();
        });

        Schema::create('detail_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->references('id')->on('pengajuan')->onDelete('cascade');
            $table->foreignId('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->foreignId('subkriteria_id')->references('id')->on('subkriteria')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
