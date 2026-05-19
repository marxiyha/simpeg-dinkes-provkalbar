<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | IDENTITAS USER
            |--------------------------------------------------------------------------
            */
            $table->string('name'); // WAJIB (fix error kamu)
            $table->string('username')->unique();
            $table->string('email')->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            /*
            |--------------------------------------------------------------------------
            | ROLE & STATUS
            |--------------------------------------------------------------------------
            */
            $table->string('role', 50)->default('Pegawai'); // Admin / Petinggi / Pegawai
            $table->boolean('is_active')->default(true);

            /*
            |--------------------------------------------------------------------------
            | PROFIL TAMBAHAN
            |--------------------------------------------------------------------------
            */
            $table->string('unit_kerja')->nullable();
            $table->string('photo')->nullable();

            /*
            |--------------------------------------------------------------------------
            | AUTH SYSTEM
            |--------------------------------------------------------------------------
            */
            $table->rememberToken();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | PASSWORD RESET TABLE
        |--------------------------------------------------------------------------
        */
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        /*
        |--------------------------------------------------------------------------
        | SESSIONS TABLE (opsional tapi bagus untuk auth Laravel)
        |--------------------------------------------------------------------------
        */
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};