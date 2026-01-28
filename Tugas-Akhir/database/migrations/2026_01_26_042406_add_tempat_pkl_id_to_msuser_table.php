<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('msuser', function (Blueprint $table) {
        $table->foreignId('tempat_pkl_id')
              ->nullable()
              ->after('role')
              ->constrained('tempat_pkl')
              ->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('msuser', function (Blueprint $table) {
        $table->dropForeign(['tempat_pkl_id']);
        $table->dropColumn('tempat_pkl_id');
    });
}

};
