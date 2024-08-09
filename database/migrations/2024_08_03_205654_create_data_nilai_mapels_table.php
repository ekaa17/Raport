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
        Schema::create('data_nilai_mapels', function (Blueprint $table) {
            $table->id(); // Kolom primary key
            $table->foreignId('nomor_induk')->constrained('siswas')->onDelete('cascade'); // Foreign key dari tabel siswa
            $table->foreignId('detail_mapel_id')->constrained('detail_mapel_kelas')->onDelete('cascade');
            $table->integer('nilai_tugas')->nullable(); // Kolom nilai tugas
            $table->integer('nilai_uts')->nullable(); // Kolom nilai uts
            $table->integer('nilai_uas')->nullable(); // Kolom nilai uas
            // $table->integer('nilai_absensi')->nullable(); // Kolom nilai absensi
            $table->integer('nilai_kepribadian')->nullable(); // Kolom nilai kepribadian
            $table->enum('status', ['ditandatangani walikelas', 'selesai'])->nullable();
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_nilai_mapels');
    }
};
