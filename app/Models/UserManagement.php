<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    protected $table = 'user_management';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];
}