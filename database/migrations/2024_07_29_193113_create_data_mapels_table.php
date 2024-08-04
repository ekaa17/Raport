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
        Schema::create('data_mapels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->enum('kelompok', ['Kelompok A', 'Kelompok B', 'Kelompok C']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mapels');
    }
};
