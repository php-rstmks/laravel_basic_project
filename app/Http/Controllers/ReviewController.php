<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Review;
use Auth;
use Log;

class ReviewController extends Controller
{
    // 商品レビュー登録ページ
    public function showRegisterPage(Product $product)
    {
        return view('reviews.register', compact('product'));
    }

    /**
     * 商品レビュー登録確認ページ
     */
    public function showRegisterConfPage(Request $request, Product $product)
    {
        $request->validate([
            'evaluation' => 'between:1,5|numeric',
            'comment' => 'required|max:500',
        ]);


        $evaluation = $request->evaluation;
        $comment = $request->comment;
        return view('reviews.register_conf', compact('product', 'evaluation', 'comment'));
    }

    public function create(Request $request, Product $product)
    {
        Review::create([
            'member_id' => Auth::id(),
            'product_id'=> $request->product_id,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);

        return view('reviews.register_comp', compact('product'));
    }

    public function list(Product $product)
    {
        $avg_review = ceil(Review::where('product_id', $product->id)->avg('evaluation'));

        return view('reviews.list', compact('product', 'avg_review'));
    }

    public function showControl()
    {
        return view('reviews.control');
    }


    public function editPage(Review $review)
    {
        $avg_review = ceil(Review::where('product_id', $review->product->id)->avg('evaluation'));

        return view('reviews.edit')
            ->with(['review' => $review, 'avg_review' => $avg_review]);

    }

    public function editConfPage(Request $request, Review $review)
    {

        $request->validate([
            'evaluation' => 'required|integer|between:1,5',
            'comment' => 'required|max:500',
        ], [
            'evaluation.integer' => '評価を正しく選択してください',
            'evaluation.between' => '評価を正しく選択してください',
        ]);

        Log::debug($request->all());

        $avg_review = ceil(Review::where('product_id', $review->product->id)->avg('evaluation'));
        return view('reviews.edit_conf')
            ->with(['comment' => $request->comment, 'evaluation' => $request->evaluation, 'review' => $review, 'avg_review' => $avg_review]);
    }

    public function edit(Request $request, Review $review)
    {
        $review->evaluation = $request->evaluation;
        $review->comment = $request->comment;

        $review->save();


        return redirect()->route('controlReviewPage');
    }

    public function deletePage(Review $review)
    {
        Log::debug($review);

        $avg_review = ceil(Review::where('product_id', $review->product->id)->avg('evaluation'));

        return view('reviews.delete')
            ->with(['review' => $review, 'avg_review' => $avg_review]);


    }

    public function delete(Review $review)
    {
        $review->delete();

        return redirect()->route('controlReviewPage');
    }

}
