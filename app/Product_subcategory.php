<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_subcategory extends Model
{
    protected $fillable = ['product_category_id', 'name'];
}
