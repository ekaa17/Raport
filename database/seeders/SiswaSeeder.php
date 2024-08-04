<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('siswas')->insert([
                'nomor_induk' => $faker->unique()->numerify('N#####'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'kelas_id' => $faker->numberBetween(1, 7),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
