<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderDinasLuar extends Model
{
    use HasFactory;

    protected $table = 'kalender_dinas_luar';

    protected $fillable = [
        'nama',
        'lokasi',
        'tanggal_dinas',
        'keterangan'
    ];

    /*
    |--------------------------------------------------------------------------
    | OPTIONAL CAST (BIAR AMAN DATE)
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'tanggal_dinas' => 'date',
    ];
}