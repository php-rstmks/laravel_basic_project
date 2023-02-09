<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function showList(Request $request)
    {
        $reviews = Review::latest()->paginate(10);
        $asc_flg = false;

        $free_word = $request->free_word;

        $query = Review::query();

        // return_stateをtrueにすることで、以下のコードに切り替えて
        // 検索条件にページネーションを適応させることができる。
        //{{ $reviews->appends(request()->query())->links('paginate.default') }}

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
                $whereQuery->where('comment', 'LIKE', $search_word);
            });
            $return_state = true;
        }

        if ($request->filled("sort_asc"))
        {
            $reviews = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
            $return_state = true;
        }

        elseif($request->filled("sort_desc"))
        {
            $reviews = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
            $return_state = true;

        }
        else {
            // 一覧ページでのデフォルトの場合に入る条件分岐
            // デフォルトでは降順
            $reviews = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
        }


        return view('admin.reviews.list')
            ->with([
                'reviews' => $reviews,
                'return_state' => $return_state,
                'asc_flg'=> $asc_flg,
                'free_word' => $free_word,
            ]);
    }

    public function detailpage(Review $review)
    {
        return view('admin.reviews.detail')
            ->with(['review' => $review]);
    }
}
