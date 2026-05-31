<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiUPT extends Model
{
    use HasFactory;

    protected $table = 'pegawai_dinkes';

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jenis_kelamin',
        'pendidikan',
        'jabatan',
        'status_pegawai',
        'tmt_pensiun',
        'batas_usia_pensiun',
    ];
}