<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom username jika belum ada
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->after('name')->unique()->nullable();
            }

            // Menambahkan kolom role jika belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('pegawai')->after('email');
            }

            // Menambahkan kolom-kolom OTP jika belum ada
            if (!Schema::hasColumn('users', 'otp_code')) {
                $table->string('otp_code')->nullable()->after('password');
            }

            if (!Schema::hasColumn('users', 'otp_expires_at')) {
                $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            }

            if (!Schema::hasColumn('users', 'otp_last_sent_at')) {
                $table->timestamp('otp_last_sent_at')->nullable()->after('otp_expires_at');
            }

            if (!Schema::hasColumn('users', 'otp_attempts')) {
                $table->integer('otp_attempts')->default(0)->after('otp_last_sent_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus semua kolom yang ditambahkan di atas jika migrasi di-rollback
            $table->dropColumn([
                'username',
                'role',
                'otp_code',
                'otp_expires_at',
                'otp_last_sent_at',
                'otp_attempts'
            ]);
        });
    }
};