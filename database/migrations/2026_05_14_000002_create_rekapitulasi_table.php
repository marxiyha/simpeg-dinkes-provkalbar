
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekapitulasi', function (Blueprint $table) {

            $table->id();

            $table->string('unit_kerja');

            $table->string('jenis_kelamin');

            $table->string('pendidikan');

            $table->string('jabatan');

            $table->string('status_pegawai');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi');
    }
};
