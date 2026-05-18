
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    protected $table = 'rekapitulasi';

    protected $fillable = [
        'unit_kerja',
        'jenis_kelamin',
        'pendidikan',
        'jabatan',
        'status_pegawai'
    ];
}
