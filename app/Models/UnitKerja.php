<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_unit';

    protected $fillable = [
        'nama_unit',
    ];

    public function pegawai()
    {
        return $this->hasMany(User::class, 'id_unit', 'id_unit');
    }
}
