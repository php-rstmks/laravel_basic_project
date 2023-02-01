<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


// class Member extends Model
class Member extends Authenticatable
{
    use softDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name_sei', 'name_mei', 'nickname', 'gender', 'email', 'password',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
