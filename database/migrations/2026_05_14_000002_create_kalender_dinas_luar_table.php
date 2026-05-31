<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_dinas_luar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai');
            $table->date('tanggal_dinas');
            $table->string('lokasi');
            $table->text('keterangan')->nullable();
            $table->string('tag_user')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_dinas_luar');
    }
};