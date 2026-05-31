<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pegawai_dinkes', function (Blueprint $table) {

            if (!Schema::hasColumn('pegawai_dinkes', 'nama_pegawai')) {
                $table->string('nama_pegawai')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'jenis_kelamin')) {
                $table->string('jenis_kelamin')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'pendidikan')) {
                $table->string('pendidikan')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'jabatan')) {
                $table->string('jabatan')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'status_pegawai')) {
                $table->string('status_pegawai')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'tmt_pensiun')) {
                $table->date('tmt_pensiun')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'batas_usia_pensiun')) {
                $table->string('batas_usia_pensiun')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'prediksi_naik_gaji')) {
                $table->string('prediksi_naik_gaji')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'prediksi_naik_pangkat')) {
                $table->string('prediksi_naik_pangkat')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('pegawai_dinkes', 'role')) {
                $table->string('role')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('pegawai_dinkes', function (Blueprint $table) {
            //
        });
    }
};