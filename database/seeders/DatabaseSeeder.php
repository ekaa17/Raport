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
        DB::table('staff')->insert([
            [
                'nip' => '12345678',
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'jenis_kelamin' => 'L',
                'role' => 'admin',
                'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '87654321',
                'nama' => 'Jane Smith',
                'email' => 'guru@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'guru',
                'walikelas' => 'ya',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '87654321',
                'nama' => 'Ariana',
                'email' => 'guru@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'guru',
                'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '87654321',
                'nama' => 'Jon Doe',
                'email' => 'kepala@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'kepala sekolah',
                'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
