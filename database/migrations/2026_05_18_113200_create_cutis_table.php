<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id('id_cuti');
            $table->foreignId('id_pegawai')->constrained('users')->onDelete('cascade');
            $table->string('jenis_cuti', 50);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status_approval', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
