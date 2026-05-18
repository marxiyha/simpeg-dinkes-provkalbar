<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderDinasLuar extends Model
{
    protected $table = 'kalender_dinas_luar';

    protected $fillable = [
        'nama_pegawai',
        'tanggal_dinas',
        'lokasi',
        'keterangan',
        'tag_user',
    ];
}