<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportData extends Model
{
    protected $table = 'export_data';

    protected $fillable = [
        'jenis_export',     // contoh: pegawai / cuti / rekap / kalender
        'format_export',    // Excel / PDF
        'tanggal_export',   // tanggal export dilakukan
    ];

    /*
    |---------------------------------------------------------
    | OPTIONAL: AUTO CASTING (biar tanggal rapi)
    |---------------------------------------------------------
    */
    protected $casts = [
        'tanggal_export' => 'date',
    ];
}