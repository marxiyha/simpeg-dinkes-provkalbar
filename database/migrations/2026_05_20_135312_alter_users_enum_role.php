<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Hanya dijalankan di MySQL/MariaDB — SQLite tidak mendukung MODIFY COLUMN.
     * Di fresh migration, kolom 'role' sudah bertipe string, jadi migrasi ini
     * hanya relevan untuk database MySQL yang sudah ada sebelumnya.
     */
    public function up(): void
    {
        if (! in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            return;
        }

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petinggi', 'pegawai', 'operator', 'superadmin') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            return;
        }

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petinggi', 'pegawai', 'superadmin') NOT NULL");
    }
};
