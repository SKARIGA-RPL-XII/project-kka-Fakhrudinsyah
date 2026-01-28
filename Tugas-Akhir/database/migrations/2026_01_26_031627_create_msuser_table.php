<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('msuser', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nama', 100);
            $table->string('nis', 10)->unique(); // max 10 digit angka
            $table->string('password');
            $table->enum('role', ['admin', 'siswa', 'pembimbing'])->default('siswa');


            // custom timestamp
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamp('tanggal_update')
                  ->useCurrent()
                  ->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('msuser');
    }
};
