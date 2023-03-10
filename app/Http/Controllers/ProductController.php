<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Product;
use App\Product_category;
use App\Product_subcategory;
use App\Review;
use Validator;


use DB;
use Auth;

class ProductController extends Controller
{

    /**
     * 商品登録ページ
     */
    public function showProductPage()
    {
        $product_categories = DB::table('product_categories')->get();
        $product_subcategories = DB::table('product_subcategories')->get();

        Log::info($product_subcategories);

        return view('products.register')
            ->with([
                'product_categories' => $product_categories,
                'product_subcategories' => $product_subcategories
            ]);

    }

    /**
     * 商品一覧、検索ページ
     */
    public function list(Request $request)
    {
        $products = Product::latest()->paginate(10);
        $product_categories = DB::table('product_categories')->get();
        $product_subcategories = DB::table('product_subcategories')->get();

        $product_subcategory_id = $request->product_subcategory_id;
        $product_category_id = $request->product_category_id;
        $free_word = $request->free_word;

        $query = Product::query();

        // 検索しているか、していないかを表す
        $return_state = false;

        // サブカテゴリがあれば（このときカテゴリは選択されている必要があるのでチェック項目には含めない）
        if ($request->filled("product_subcategory_id"))
        {
            $query->where("product_subcategory_id", $product_subcategory_id);

            $return_state = true;

        } elseif ($request->filled("product_category_id"))
        // サブカレゴリを含めずにカテゴリのみを検索条件に含めていれば
        {
            $query->where("product_category_id", $product_category_id);
            $return_state = true;

        }

        // フリーワードのinputが存在し、かつ空でなければ
        if ($request->filled("free_word"))
        {
            $search_word = '%'.$free_word.'%';
            $query->where(function ($query) use ($search_word) {
                $query->where('name', 'LIKE', $search_word);
                $query->orWhere('product_content', 'LIKE', $search_word);
            });
            $return_state = true;

        }

        $products = $query->orderBy('id', "DESC")->paginate(10);

        Log::debug($products);

        return view('products.list')
            ->with([
                'product_categories' => $product_categories,
                'product_subcategories' => $product_subcategories,
                'products' => $products,
                'return_state' => $return_state,
                'return_product_category_id' => $product_category_id,
                'return_product_subcategory_id' => $product_subcategory_id,
            ]);
    }

    /**
     * 詳細ページ
     */
    public function show(Product $product)
    {

        // 総合評価
        $avg_review = ceil(Review::where('product_id', $product->id)->avg('evaluation'));

        return view('products.show', compact('product', 'avg_review'));
    }


    /**
     *ajaxでsubcategoryを取得してjson形式で返す
     *
     */
    public function setSubCategory(Request $request)
    {
        Log::debug('jlk');
        $product_subcategories = DB::table('product_subcategories')
            ->where('product_category_id', $request->categoryId)
            ->get();

        return response()->json([
            'product_subcategories' => $product_subcategories,
        ]);
    }

    /**
     * ajaxで画像を表示させる。
     *
     */
    public function registerImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image_1' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_4' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($validator->fails())
        {
            return response()->json(['returnErr'=>'damedesu']);
        }

        if ($request->has('image_1'))
        {
            $file_name = $request->file('image_1')->getClientOriginalName();

            $request->file('image_1')->storeAs('public', $file_name);

            return response()->json(['returnFileName1' => $file_name]);
        }

        if ($request->has('image_4'))
        {
            $file_name = $request->file('image_4')->getClientOriginalName();

            $request->file('image_4')->storeAs('public', $file_name);

            return response()->json(['returnFileName4' => $file_name]);
        }

        if ($request->has('image_2'))
        {
            $file_name = $request->file('image_2')->getClientOriginalName();

            $request->file('image_2')->storeAs('public', $file_name);

            return response()->json(['returnFileName2' => $file_name]);
        }

        if ($request->has('image_3'))
        {
            $file_name = $request->file('image_3')->getClientOriginalName();

            $request->file('image_3')->storeAs('public', $file_name);

            return response()->json(['returnFileName3' => $file_name]);
        }
    }

    /**
     * 商品登録画面から商品登録確認画面へ
     *
     */
    public function registerConf(Request $request)
    {

        $request->validate([
            'product_name' => 'required|max:100',
            'product_category_id' => 'integer|not_in:0|between:1,5',
            'product_subcategory_id' => 'integer|not_in:0|between:1,25',
            'product_content' => 'required|max:500',
        ], [
            'product_name.required' => '商品名は必須です',
            'product_name.max' => '商品名は100文字以内で入力してください',
            'product_category_id.not_in' => 'カテゴリーを選択してください',
            'product_category_id.integer' => 'カテゴリーを正しく選択してください',
            'product_category_id.between' => 'カテゴリーを正しく選択してください',
            'product_subcategory_id.not_in' => 'サブカテゴリーを選択してください',
            'product_subcategory_id.integer' => 'サブカテゴリーを正しく選択してください',
            'product_subcategory_id.between' => 'サブカテゴリーを正しく選択してください',
            'product_content.required' => '商品説明は必須です',
            'product_content.max' => '商品説明は500文字以内で入力してください',
        ]);

        $category = Product_category::find($request->product_category_id);
        $sub_category = Product_subcategory::find($request->product_subcategory_id);

        return view('products.confirm')
            ->with(['product' => $request->all(), 'category' => $category, 'sub_category' => $sub_category]);

    }

    /**
     * register_confページで使用
     */
    public function registerProduct(Request $request)
    {

        Product::create([
            'member_id' => Auth::id(),
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'name' => $request->product_name,
            'image_1' => $request->image_1,
            'image_2' => $request->image_2,
            'image_3' => $request->image_3,
            'image_4' => $request->image_4,
            'product_content' => $request->product_content,
        ]);


        return redirect()->route('product.list');
    }

}
