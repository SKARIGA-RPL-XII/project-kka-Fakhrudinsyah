<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('msuser')->insert([
            'nama' => 'Administrator',
            'nis' => '24027',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'tanggal_dibuat' => now(),
            'tanggal_update' => now(),
        ]);
    }
}
