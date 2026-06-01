<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Field yang boleh diisi (mass assignment)
     */
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
        'nip',
        'tmt_pegawai',
        'id_unit',
    ];

    /**
     * Field yang disembunyikan saat return JSON / array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Cast otomatis untuk tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'otp_last_sent_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit', 'id_unit');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'user_id');
    }

    public function dinasLuar()
    {
        return $this->hasMany(DinasLuar::class, 'user_id');
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
