<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_mapels')->insert([
            [
                'nama_mapel' => 'Bahasa Indonesia',
                'kelompok' => 'Kelompok A'
            ],
            [
                'nama_mapel' => 'Matematika',
                'kelompok' => 'Kelompok A'
            ],
            [
                'nama_mapel' => 'Bahasa Inggris',
                'kelompok' => 'Kelompok A'
            ],
            [
                'nama_mapel' => 'Managemen Bisnis',
                'kelompok' => 'Kelompok B'
            ],
            [
                'nama_mapel' => 'Praktik Akuntasi Lembaga',
                'kelompok' => 'Kelompok C'
            ],
            [
                'nama_mapel' => 'Praktik Komunikasi',
                'kelompok' => 'Kelompok C'
            ],
        ]);
    }
}
