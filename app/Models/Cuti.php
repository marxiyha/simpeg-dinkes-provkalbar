<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cuti';

    protected $fillable = [
        'id_pegawai',
        'jenis_cuti',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_approval',
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }
}
