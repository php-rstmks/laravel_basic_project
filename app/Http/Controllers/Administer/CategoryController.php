<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_category;

use Log;
use App\Product_subcategory;

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
}
