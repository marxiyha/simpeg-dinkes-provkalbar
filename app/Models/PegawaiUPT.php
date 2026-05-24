<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiUPT extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     * Pastikan nama ini sama persis dengan yang ada di phpMyAdmin.
     */
    protected $table = 'pegawai_upt';

    /**
     * Kolom-kolom yang boleh diisi (Mass Assignable).
     * Sesuaikan array ini dengan kolom yang ada di tabel Anda.
     */
    protected $fillable = [
        'nama_pegawai',
        'email',
        'nip',
        'upt_unit',
        'jabatan',
        'status_pegawai',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    /**
     * Jika Anda tidak menggunakan timestamps (created_at, updated_at),
     * set variabel ini ke false. Jika menggunakan, hapus baris di bawah ini.
     */
    public $timestamps = true;
}