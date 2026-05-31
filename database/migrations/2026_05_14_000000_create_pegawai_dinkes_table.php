<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawai_dinkes', function (Blueprint $table) {

            $table->id();

            $table->string('nip')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status_pegawai')->nullable();

            $table->date('tmt_pensiun')->nullable();
            $table->string('batas_usia_pensiun')->nullable();

            $table->string('prediksi_naik_gaji')->nullable();
            $table->string('prediksi_naik_pangkat')->nullable();

            $table->string('email')->nullable();
            $table->string('role')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_dinkes');
    }
};