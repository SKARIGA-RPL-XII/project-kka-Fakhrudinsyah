<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('msuser')
            ->where('role', 'admin')
            ->update([
                'username' => 'Admin',
                'nama'     => 'Administrator',
                'nis'      => null,
            ]);
    }

    public function down(): void
    {
        DB::table('msuser')
            ->where('role', 'admin')
            ->update([
                'username' => null,
                'nama'     => 'Administrator',
                'nis'      => '24027', 
            ]);
    }
};
