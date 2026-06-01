<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cuti extends Model
{
    use HasFactory;

    // ⚠️ GANTI SESUAI NAMA TABLE DI DATABASE KAMU
    protected $table = 'cuti'; 
    // kalau tabel kamu ternyata "cutis", ubah jadi:
    // protected $table = 'cutis';

    protected $fillable = [
        'user_id',
        'jenis_cuti',
        'tanggal_mulai',
        'tanggal_selesai',
        'alasan',
        'status',
    ];

    /**
     * RELASI USER
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS FOR BLADE COMPATIBILITY
    |--------------------------------------------------------------------------
    */

    public function getNamaAttribute()
    {
        return $this->user?->name ?? '-';
    }

    public function getStatusPengajuanAttribute()
    {
        return $this->status === 'Pending' ? 'Menunggu' : $this->status;
    }

    public function getBidangAttribute()
    {
        return $this->user?->unitKerja?->nama_unit ?? 'Dinas Kesehatan';
    }
}