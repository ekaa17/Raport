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
            $table->decimal('nilai_tugas', 5, 2)->nullable(); // Kolom nilai tugas
            $table->decimal('nilai_uts', 5, 2)->nullable(); // Kolom nilai uts
            $table->decimal('nilai_uas', 5, 2)->nullable(); // Kolom nilai uas
            // $table->decimal('nilai_absensi', 5, 2)->nullable(); // Kolom nilai absensi
            $table->decimal('nilai_kepribadian', 5, 2)->nullable(); // Kolom nilai kepribadian
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
