<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function fieldTasks()
    {
        return $this->hasMany(FieldTask::class);
    }
}



namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable([
    'name', 'email', 'password', 'role', 'id_unit', 'nip', 'tanggal_lahir',
    'jenis_kelamin', 'pendidikan_terakhir', 'jabatan', 'status_pegawai',
    'tmt_pegawai', 'tmt_pensiun', 'batas_usia_pensiun', 'perkiraan_naik_jabatan', 'perkiraan_naik_gaji',
])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'tmt_pegawai' => 'date',
            'tmt_pensiun' => 'date',
        ];
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit', 'id_unit');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_pegawai');
    }

    public function dinasLuar()
    {
        return $this->hasMany(DinasLuar::class, 'user_id');
    }
}
