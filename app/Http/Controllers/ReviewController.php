<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Review;
use Auth;
use Log;

class ReviewController extends Controller
{
    public function showRegisterPage(Product $product)
    {
        return view('reviews.register', compact('product'));
    }

    /**
     * 商品レビューページ
     */
    public function showRegisterConfPage(Request $request, Product $product)
    {
        $evaluation = $request->evaluation;
        $comment = $request->comment;
        return view('reviews.register_conf', compact('product', 'evaluation', 'comment'));
    }

    public function create (Request $request, Product $product)
    {
        $request->validate([
            // 'evaluate' => 'required|',
            'comment' => 'required|max:500',
        ]);

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
        return view('reviews.list', compact('product'));
    }

}
