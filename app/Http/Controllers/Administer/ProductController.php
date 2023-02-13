<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\Product_category;
use App\Product_subcategory;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\MemberEditRequest;
use Log;


class ProductController extends Controller
{
    public function showList(Request $request)
    {
        $products = Product::latest()->paginate(10);
        $asc_flg = false;

        $free_word = $request->free_word;

        $query = Product::query();

        // return_stateをtrueにすることで、以下のコードに切り替えて
        // 検索条件にページネーションを適応させることができる。
        //{{ $products->appends(request()->query())->links('paginate.default') }}

        $return_state = false;

        // idがあれば（このときカテゴリは選択されている必要があるのでチェック項目には含めない）
        if ($request->filled("id"))
        {
            $query->where("id", $request->id);

            $return_state = true;
        }

        // フリーワードのinputが存在し、かつ空でなければ
        if ($request->filled("free_word"))
        {
            $search_word = '%' . $free_word . '%';
            $query->where(function ($whereQuery) use ($search_word) {
                $whereQuery->where('name', 'LIKE', $search_word);
                $whereQuery->orWhere('product_content', 'LIKE', $search_word);
            });
            $return_state = true;
        }

        if ($request->filled("sort_asc"))
        {
            $products = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
            $return_state = true;
        }

        elseif($request->filled("sort_desc"))
        {
            $products = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
            $return_state = true;

        }
        else {
            // 一覧ページでのデフォルトの場合に入る条件分岐
            // デフォルトでは降順
            $products = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
        }


        return view('admin.products.list')
            ->with([
                'products' => $products,
                'return_state' => $return_state,
                'asc_flg'=> $asc_flg,
                'free_word' => $free_word,
            ]);
    }

    public function registerpage()
    {
        $register = 'a';
        $edit = null;
        $product_categories = Product_category::all();
        $product_subcategories = Product_subcategory::all();

        return view('admin.products.register', compact('register', 'edit', 'product_categories', 'product_subcategories'));
    }

    public function register_confpage(Request $request)
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

        $register = 'a';
        $edit = null;
        $Info = $request->all();

        Log::info($Info);

        return view('admin.products.register_conf', compact('register', 'edit', 'Info'));

    }

    public function register(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        Log::info($request->all());

        $product = new Product();
        $product->member_id = 1;
        $product->name = $request->product_name;
        $product->product_category_id = $request->product_category_id;
        $product->product_subcategory_id = $request->product_subcategory_id;
        $product->image_1 = $request->image_1;
        $product->image_2 = $request->image_2;
        $product->image_3 = $request->image_3;
        $product->image_4 = $request->image_4;
        $product->product_content = $request->product_content;

        $product->save();

        return redirect()
            ->route('admin.products.list');
    }

    public function editpage(Product $product)
    {
        $product_categories = DB::table('product_categories')->get();
        $product_subcategories = DB::table('product_subcategories')->get();

        Log::info($product_subcategories);

        $register = null;

        $edit = "a";
        return view('admin.products.edit')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'product' => $product,
                'product_categories' => $product_categories,
                'product_subcategories' => $product_subcategories,
            ]);
    }

    public function edit_confpage(Request $request, Product $product)
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


        $register = null;
        $edit = "a";
        $Info = $request->all();
        return view('admin.products.edit_conf')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'Info' => $Info,
                'product' => $product,
            ]);
    }

    public function edit(Request $request, Product $product)
    {
        $product->product_category_id = $request->product_category_id;
        $product->product_subcategory_id = $request->product_subcategory_id;
        $product->name = $request->product_name;
        $product->image_1 = $request->image_1;
        $product->image_2 = $request->image_2;
        $product->image_3 = $request->image_3;
        $product->image_4 = $request->image_4;

        $product->save();

        return redirect()
            ->route('admin.products.list');

    }

    public function detailpage(Product $product)
    {
        $avg_review = ceil(Review::where('product_id', $product->id)->avg('evaluation'));

        $reviews = Review::where('product_id', $product->id)->paginate(3);

        return view('admin.products.detail')
            ->with([
                'product' => $product,
                'avg_review' => $avg_review,
                'reviews' => $reviews,
            ]);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.list');
    }
}
