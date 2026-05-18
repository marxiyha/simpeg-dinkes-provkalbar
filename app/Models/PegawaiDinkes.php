<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiDinkes extends Model
{
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
        'prediksi_naik_gaji',
        'prediksi_naik_pangkat',
        'email',
        'role',
    ];
}