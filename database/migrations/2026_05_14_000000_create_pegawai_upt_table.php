
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai_upt', function (Blueprint $table) {

            $table->id();

            $table->string('nip');

            $table->string('nama');

            $table->string('jenis_kelamin');

            $table->string('pendidikan');

            $table->string('jabatan');

            $table->string('status')->default('Aktif');

            $table->string('upt');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_upt');
    }
};
