
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_cuti', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('jenis_cuti');

            $table->date('tanggal_cuti');

            $table->string('status_pengajuan');

            $table->string('bidang');

            $table->text('alasan');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_cuti');
    }
};
