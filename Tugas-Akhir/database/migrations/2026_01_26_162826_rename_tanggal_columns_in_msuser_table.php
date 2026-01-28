<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTanggalColumnsInMsuserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->renameColumn('tanggal_dibuat', 'created_at');
            $table->renameColumn('tanggal_update', 'updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->renameColumn('created_at', 'tanggal_dibuat');
            $table->renameColumn('updated_at', 'tanggal_update');
        });
    }
}
