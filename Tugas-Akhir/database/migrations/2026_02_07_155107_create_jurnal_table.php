<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->date('tanggal');
            $table->string('judul');
            $table->text('kegiatan');

            $table->enum('status', ['pending', 'disetujui', 'revisi'])
                  ->default('pending');

            $table->text('catatan_pembimbing')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')
                  ->references('user_id')
                  ->on('msuser')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
