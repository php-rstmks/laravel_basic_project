<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_category;
use Log;
use App\Product_subcategory;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    public function showList(Request $request)
    {
        $categories = Product_category::latest()->paginate(10);
        $asc_flg = false;

        $free_word = $request->free_word;

        $query = Product_category::query();

        // return_stateをtrueにすることで、以下のコードに切り替えて
        // 検索条件にページネーションを適応させることができる。
        //{{ $categories->appends(request()->query())->links('paginate.default') }}

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

            $categoryIds_linked_with_subcategories_meet_free_word = Product_subcategory::where('name', 'LIKE', $search_word)->pluck('product_category_id');

            Log::debug('サブカテゴリがあればこれ' . $categoryIds_linked_with_subcategories_meet_free_word);

            // $query->join('product_subcategories', 'product_categories.id', '=', 'product_subcategories.product_category_id');


            $query->where(function ($whereQuery) use ($search_word, $categoryIds_linked_with_subcategories_meet_free_word) {
                $whereQuery->where('name', 'LIKE', $search_word);
                // $whereQuery->where('product_categories.name', 'LIKE', $search_word);
                // $whereQuery->orWhere('product_subcategories.name', 'LIKE', $search_word);

                foreach ($categoryIds_linked_with_subcategories_meet_free_word as $category_id)
                {
                    $whereQuery->orWhere('id', $category_id);
                }
            });

            $return_state = true;
        }

        if ($request->filled("sort_asc"))
        {
            $categories = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
            $return_state = true;
        }

        elseif($request->filled("sort_desc"))
        {
            $categories = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
            $return_state = true;

        }
        else {
            // 一覧ページでのデフォルトの場合に入る条件分岐
            // デフォルトでは降順
            $categories = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
        }


        return view('admin.categories.list')
            ->with([
                'categories' => $categories,
                'return_state' => $return_state,
                'asc_flg'=> $asc_flg,
                'free_word' => $free_word,
            ]);
    }

    public function registerpage()
    {
        $register = 'a';
        $edit = null;
        return view('admin.categories.register', compact('register', 'edit'));
    }

    public function register_confpage(CategoryRequest $request)
    {
        $register = 'a';
        $edit = null;
        $Info = $request->all();

        return view('admin.categories.register_conf', compact('register', 'edit', 'Info'));

    }

    public function register(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        Product_category::create([
            'member_id' => 1,
            'product_id' => $request->product_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('admin.categories.list');
    }


    public function editpage(Product_category $product_category)
    {
        $register = null;

        $edit = "a";
        return view('admin.categories.edit')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'product_category' => $product_category,
            ]);
    }

    public function edit_confpage(ReviewRequest $request, Review $review)
    {
        $avg_review = ceil(Review::where('product_id', $review->product->id)->avg('evaluation'));


        $register = null;
        $edit = "a";
        $Info = $request->all();
        Log::debug($Info);
        return view('admin.categories.edit_conf')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'Info' => $Info,
                'review' => $review,
                'avg_review' => $avg_review
            ]);
    }

    public function edit(Request $request, Review $review)
    {
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;

        $review->save();

        return redirect()
            ->route('admin.categories.list');

    }


    public function detailpage(Product_category $category)
    {
        $subcategories_linked_with_category = Product_subcategory::where("product_category_id", $category->id)->get();

        Log::debug($subcategories_linked_with_category);
        return view('admin.categories.detail')
            ->with([
                'category' => $category,
                'subcategories_linked_with_category' => $subcategories_linked_with_category,
            ]);
    }

    public function delete(Product_category $category)
    {
        $subcategories = Product_subcategory::where("product_category_id" , $category->id)->get();

        foreach ($subcategories as $subcategory)
        {
            $subcategory->delete();
        }

        $category->delete();

        return redirect()->route('admin.categories.list');
    }
}
