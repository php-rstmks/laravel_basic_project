<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product_category extends Model
{
    use softDeletes;

    protected $fillable = ['name'];
}
