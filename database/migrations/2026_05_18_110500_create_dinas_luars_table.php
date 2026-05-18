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
        Schema::create('dinas_luars', function (Blueprint $table) {
            $table->id('id_dinas');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_dinas');
            $table->date('tanggal_selesai')->nullable();
            $table->string('tujuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dinas_luars');
    }
};
