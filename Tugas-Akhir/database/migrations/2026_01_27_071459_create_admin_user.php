<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan table msuser sudah ada
        DB::table('msuser')->insert([
            'nama'     => 'Admin',
            'nis'      => '24027',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('msuser')->where('nis', '24027')->delete();
    }
};
