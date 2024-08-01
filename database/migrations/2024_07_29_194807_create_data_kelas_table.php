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
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')
                ->constrained('jurusans', 'id')
                ->onDelete('cascade');
            $table->foreignId('mapel_id')
                ->constrained('data_mapels')
                ->onDelete('cascade');
            $table->string('nama_kelas');
            $table->enum('kelas', ['10', '11', '12']);
            $table->foreignId('tahun_ajaran_id')
                ->constrained('data_tahun_ajarans')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};
