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
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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