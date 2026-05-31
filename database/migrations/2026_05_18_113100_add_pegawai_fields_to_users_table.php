<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_unit')->nullable()->constrained('unit_kerjas', 'id_unit')->onDelete('set null');
            $table->string('nip', 20)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->enum('status_pegawai', ['PNS', 'PPPK'])->nullable();
            $table->date('tmt_pensiun')->nullable();
            $table->integer('batas_usia_pensiun')->nullable();
            $table->string('perkiraan_naik_jabatan', 100)->nullable();
            $table->string('perkiraan_naik_gaji', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_unit']);
            $table->dropColumn([
                'id_unit', 'nip', 'tanggal_lahir', 'jenis_kelamin',
                'pendidikan_terakhir', 'jabatan', 'status_pegawai',
                'tmt_pensiun', 'batas_usia_pensiun', 'perkiraan_naik_jabatan',
                'perkiraan_naik_gaji'
            ]);
        });
    }
};
