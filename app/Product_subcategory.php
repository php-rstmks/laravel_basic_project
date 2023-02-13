<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product_subcategory extends Model
{
    use softDeletes;

    protected $fillable = ['product_category_id', 'name'];
}
