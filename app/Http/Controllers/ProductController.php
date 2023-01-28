<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class ProductController extends Controller
{
    public function registerImage(Request $request)
    {
        $request->validate([
            'image_1' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_3' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_4' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        Log::info('バリデーション後', ['image_1の情報' => $request->all()]);

        Log::info($request->image_1 . 'です');

        return response()->json(['returnFileName1' => 'ok']);

        if ($file1 = $request->image_1) {
            Log::debug($file1);
            $fileName1 = time() . $file1->getClientOriginalName();

            // $target_path1 = public_path('uploads/');
            // ここでOSが違うことによるエラーがでる
            $target_path1 = public_path('uploads\\');
            $file1->move($target_path1, $fileName1);
            return ['returnFileName1' => $fileName1];
        }
    }
}
