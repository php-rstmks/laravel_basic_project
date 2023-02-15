<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product_subcategory;

class Product_category extends Model
{
    use softDeletes;

    protected $fillable = ['name'];

    public function product_subcategories()
    {
        return $this->hasMany(Product_subcategory::class);
    }
}
