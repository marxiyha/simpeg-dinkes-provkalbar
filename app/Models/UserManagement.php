<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserManagement extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang terhubung dengan model ini di database Laragon.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Properti kolom yang diizinkan untuk diisi secara massal (Mass Assignment).
     * Sangat krusial agar fungsi UserManagement::create() di Controller berjalan lancar.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'unit_kerja',
        'photo',
    ];

    /**
     * Properti kolom yang harus disembunyikan saat data di-export atau dikonversi ke Array/JSON.
     * Demi keamanan, kolom password dan remember_token wajib disembunyikan.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Aturan konversi / casting tipe data kolom secara otomatis oleh Eloquent.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Otomatis memastikan hashing password berjalan optimal di Laravel terbaru
        'is_active' => 'boolean',
    ];
}