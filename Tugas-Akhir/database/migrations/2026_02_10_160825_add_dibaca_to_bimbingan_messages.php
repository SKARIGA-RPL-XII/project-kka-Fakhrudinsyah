<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bimbingan_messages', function (Blueprint $table) {
            $table->boolean('dibaca')
                  ->default(false)
                  ->after('file'); // sesuaikan kolom terakhir
        });
    }

    public function down(): void
    {
        Schema::table('bimbingan_messages', function (Blueprint $table) {
            $table->dropColumn('dibaca');
        });
    }
};
