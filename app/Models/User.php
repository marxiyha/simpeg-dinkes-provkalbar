<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Field yang boleh diisi
     */

    protected $fillable = [

        'username',

        'name',

        'email',

        'password',

        'role',

        'is_active',
    ];

    /**
     * Hidden field
     */

    protected $hidden = [

        'password',

        'remember_token',
    ];

    /**
     * Casting
     */

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'is_active' => 'boolean',
        ];
    }
}