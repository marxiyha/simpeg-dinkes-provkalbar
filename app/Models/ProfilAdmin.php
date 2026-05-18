
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilAdmin extends Model
{
    protected $table = 'profil_admin';

    protected $fillable = [

        'username',
        'email',
        'password'

    ];
}

