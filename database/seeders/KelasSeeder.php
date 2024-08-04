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
                'nama_kelas' => 'K1',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '1',
                'nama_kelas' => 'K2',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '2',
                'nama_kelas' => 'A1',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '2',
                'nama_kelas' => 'A1',
                'kelas' => 11,
            ],
            [
                'jurusan_id' => '2',
                'nama_kelas' => 'A1',
                'kelas' => 12,
            ],
            [
                'jurusan_id' => '3',
                'nama_kelas' => 'B1',
                'kelas' => 10,
            ],
            [
                'jurusan_id' => '4',
                'nama_kelas' => 'M1',
                'kelas' => 10,
            ],
        ]);
    }
}
