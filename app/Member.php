<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Member extends Model
class Member extends Authenticatable
{
    protected $fillable = [
        'name_sei', 'name_mei', 'nickname', 'gender', 'email', 'password',
    ];
}
