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
        Schema::create('data_wali_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelas')
                ->constrained('data_kelas')
                ->onDelete('cascade');
            $table->foreignId('id_staff')
                ->constrained('staff')
                ->onDelete('cascade');
            $table->foreignId('data_tahun_ajarans_id')
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
        Schema::dropIfExists('data_wali_kelas');
    }
};
