<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tempat_pkl', function (Blueprint $table) {
            // Rename kolom id menjadi tempat_pkl_id
            $table->renameColumn('id', 'tempat_pkl_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tempat_pkl', function (Blueprint $table) {
            // Kembalikan nama kolom ke id
            $table->renameColumn('tempat_pkl_id', 'id');
        });
    }
};
