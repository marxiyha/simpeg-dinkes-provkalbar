<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    protected $table = 'pengajuan_cuti';

    protected $fillable = [
        'nama',
        'nip',
        'jenis_cuti',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_pengajuan',
        'alasan',
        'bidang',
        'unit_kerja',
    ];
}