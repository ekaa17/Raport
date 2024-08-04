<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                // 'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '23456789',
                'nama' => 'Jane Smith',
                'email' => 'guru@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'guru',
                // 'walikelas' => 'ya',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '34567891',
                'nama' => 'Ariana',
                'email' => 'guru@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'guru',
                // 'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '87654323',
                'nama' => 'Jon Doe',
                'email' => 'kepala@gmail.com',
                'jenis_kelamin' => 'P',
                'role' => 'kepala sekolah',
                // 'walikelas' => 'tidak',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
