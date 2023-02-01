<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Administer extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'login_id', 'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
