<?php

namespace App;

use Keyhunter\Administrator\AuthRepository as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'password', 'email', 'judet', 'location', 'adress', 'phone', 'role_id', 'verify_token', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

