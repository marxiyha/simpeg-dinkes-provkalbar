<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            /**
             * DATA USER
             */

            $table->string('username');

            $table->string('name');

            $table->string('email')->unique();

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            /**
             * ROLE USER
             */

            $table->enum('role', [

                'Super Admin',

                'Kepala UPT',

                'Operator',

                'Pegawai'

            ])->default('Pegawai');

            /**
             * STATUS AKUN
             */

            $table->boolean('is_active')->default(true);

            /**
             * UNIT KERJA
             */

            $table->string('unit_kerja')->nullable();

            /**
             * FOTO PROFILE
             */

            $table->string('photo')->nullable();

            /**
             * REMEMBER LOGIN
             */

            $table->rememberToken();

            /**
             * CREATED & UPDATED
             */

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations
     */

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};