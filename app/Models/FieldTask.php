<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination',
        'start_date',
        'end_date',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}