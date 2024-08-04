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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id(); // Kolom primary key, dihasilkan secara otomatis
            $table->string('nomor_induk')->unique(); // Kolom nomor_induk dengan constraint unik
            $table->string('nama'); // Kolom nama
            $table->enum('jenis_kelamin', ['L', 'P']); // Kolom jenis_kelamin dengan enum
            $table->text('alamat'); // Kolom alamat
            $table->foreignId('kelas_id')->constrained('data_kelas')->onDelete('cascade'); // Kolom foreign key untuk tabel kelas
            $table->timestamps(); // Kolom timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
};
