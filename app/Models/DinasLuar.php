<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DinasLuar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dinas';

    protected $fillable = [
        'user_id',
        'tanggal_dinas',
        'tanggal_selesai',
        'tujuan',
        'keterangan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
