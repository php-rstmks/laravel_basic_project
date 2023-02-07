<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;

class ProductController extends Controller
{
    public function showList(Request $request)
    {
        // $products = Product::latest()->paginate(4);
        // $products = DB::table('products')->paginate(4);
        $products = Product::latest()->get();
        return view('admin.products.list', compact('products'));

    }
}
