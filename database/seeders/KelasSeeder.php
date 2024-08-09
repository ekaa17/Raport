<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_kelas')->insert([
            [
                'jurusan_id' => '1',
                'nama_kelas' => 'AK1',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '1',
                'nama_kelas' => 'AK2',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '2',
                'nama_kelas' => 'PB1',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '2',
                'nama_kelas' => 'PB1',
                'kelas' => 11,
            ]

        ]);
    }
}
