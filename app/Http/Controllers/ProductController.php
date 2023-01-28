<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
// use App\Product;
use DB;

class ProductController extends Controller
{

    public function showProductPage()
    {
        // $product_categories = Product::latest()->get();
        $product_categories = DB::table('product_categories')->get();
        $product_subcategories = DB::table('product_subcategories')->get();

        return view('products.register')
            ->with([
                'product_categories' => $product_categories,
                'product_subcategories' => $product_subcategories
            ]);

    }

    /**
     *ajaxでsubcategoryを取得してjson形式で返す
     *
     */
    public function setSubCategory(Request $request)
    {
        $product_subcategories = DB::table('product_subcategories')
        ->where('product_category_id', $request->categoryId)
        ->get();

        return response()->json([
            'product_subcategories' => $product_subcategories,
        ]);
    }

    /**
     *
     */
    public function registerImage(Request $request)
    {
        $request->validate([
            'image_1' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_4' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->has('image_1'))
        {
            $file_name = $request->file('image_1')->getClientOriginalName();

            $request->file('image_1')->storeAs('public', $file_name);

            return response()->json(['returnFileName1' => $file_name]);

        }
    }

    public function registerProduct(Request $request)
    {

    }
}
