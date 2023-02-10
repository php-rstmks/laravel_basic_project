<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;
use App\Product;
use Log;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Hash;


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

    public function registerpage()
    {
        $register = 'a';
        $edit = null;
        return view('admin.reviews.register', compact('register', 'edit'));
    }

    public function register_confpage(ReviewRequest $request)
    {
        $avg_review = ceil(Review::where('product_id', $request->product_id)->avg('evaluation'));

        $register = 'a';
        $edit = null;
        $Info = $request->all();

        $product = Product::find($request->product_id);

        Log::debug($request->product_id);
        Log::debug($product);

        return view('admin.reviews.register_conf', compact('register', 'edit', 'Info', 'avg_review', 'product'));

    }

    public function register(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        Review::create([
            'member_id' => 1,
            'product_id' => $request->product_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('admin.reviews.list');
    }


    public function editpage(Review $review)
    {
        $register = null;

        $edit = "a";
        return view('admin.reviews.edit')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'review' => $review,
            ]);
    }

    public function edit_confpage(ReviewRequest $request, Review $review)
    {
        $avg_review = ceil(Review::where('product_id', $review->product->id)->avg('evaluation'));


        $register = null;
        $edit = "a";
        $Info = $request->all();
        Log::debug($Info);
        return view('admin.reviews.edit_conf')
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
            ->route('admin.reviews.list');

    }

    public function detailpage(Review $review)
    {
        return view('admin.reviews.detail')
            ->with(['review' => $review]);
    }

    public function delete(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.list');
    }
}
