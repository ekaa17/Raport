<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('data_tahun_ajarans')->insert([
            [
                'tahun_ajaran' => '2023/2024',
                'semester' => 'Ganjil',
                'status' => 'aktif',
            ],
        ]);

        $this->call([
            StaffSeeder::class,
            JurusanSeeder::class,
            KelasSeeder::class,
            MapelSeeder::class,
            SiswaSeeder::class,
        ]);
    }
}
