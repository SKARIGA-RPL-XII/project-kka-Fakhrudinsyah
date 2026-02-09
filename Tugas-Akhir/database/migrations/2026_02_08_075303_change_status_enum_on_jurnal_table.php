<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah enum status jadi:
     * menunggu | diterima
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE jurnal 
            MODIFY status ENUM('menunggu', 'diterima') 
            NOT NULL DEFAULT 'menunggu'
        ");
    }

    /**
     * Rollback ke kondisi lama
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE jurnal 
            MODIFY status ENUM('pending', 'disetujui', 'ditolak') 
            NOT NULL
        ");
    }
};
