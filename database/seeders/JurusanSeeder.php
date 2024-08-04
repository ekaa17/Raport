<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusans')->insert([
            [
                'nama_jurusan' => 'Komunikasi',
            ],
            [
                'nama_jurusan' => 'Akutansi',
            ],
            [
                'nama_jurusan' => 'Bisnis',
            ],
            [
                'nama_jurusan' => 'Managemen',
            ],
        ]);
    }
}
