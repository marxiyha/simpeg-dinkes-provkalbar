<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Field yang boleh diisi (mass assignment)
     */
    // app/Models/User.php
protected $fillable = [
    'name',
    'username',
    'email',
    'password',
    'role',
    'otp_code',
    'otp_expires_at',
    'otp_last_sent_at',
    'otp_attempts',
];

    /**
     * Field yang disembunyikan saat return JSON / array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast otomatis untuk tipe data
     */
    protected $casts = [
    'email_verified_at' => 'datetime',
   // 'password' => 'hashed', // 🔥 HAPUS ATAU KOMENTARI BARIS INI
];

    /*
    |--------------------------------------------------------------------------
    | ROLE HELPER
    |--------------------------------------------------------------------------
    | Mempermudah pengecekan role di controller / blade
    */

    public function isPetinggi(): bool
    {
        return $this->role === 'petinggi';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPegawai(): bool
    {
        return $this->role === 'pegawai';
    }
}