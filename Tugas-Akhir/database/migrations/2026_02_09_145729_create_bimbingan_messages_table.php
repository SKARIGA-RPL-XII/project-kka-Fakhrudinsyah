<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bimbingan_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('pembimbing_id');
            $table->text('pesan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('user_id')->on('msuser')->cascadeOnDelete();
            $table->foreign('pembimbing_id')->references('user_id')->on('msuser')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bimbingan_messages');
    }
};
