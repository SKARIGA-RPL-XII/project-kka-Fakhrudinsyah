<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->unsignedBigInteger('pembimbing_id')
                  ->nullable()
                  ->after('tempat_pkl_id');

            $table->foreign('pembimbing_id')
                  ->references('user_id')
                  ->on('msuser')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('msuser', function (Blueprint $table) {
            $table->dropForeign(['pembimbing_id']);
            $table->dropColumn('pembimbing_id');
        });
    }
};
