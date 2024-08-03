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
        Schema::create('detail_mapel_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')
            ->constrained('data_kelas', 'id')
            ->onDelete('cascade');
            $table->foreignId('mapel_id')
            ->constrained('data_mapels', 'id')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_mapel_kelas');
    }
};
