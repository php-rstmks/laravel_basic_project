<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Log;

class MemberController extends Controller
{
    public function showList(Request $request)
    {
        $members = Member::latest()->paginate(10);
        $asc_flg = true;

        // $id = $request->id;
        $man = $request->man;
        $woman = $request->woman;
        $free_word = $request->free_word;

        $query = Member::query();

        $return_state = false;

        // idがあれば（このときカテゴリは選択されている必要があるのでチェック項目には含めない）
        if ($request->filled("id"))
        {
            $query->where("id", $request->id);

            $return_state = true;
        }

        if ($request->filled('man') && $request->filled('woman')) {
            $query->where(function ($query) use ($request) {
                $query->where('gender', $request->man);
                $query->orWhere('gender', $request->woman);
            });
            $return_state = true;

        } elseif ($request->filled('man')) {
            $query->where('gender', $request->man);
            $return_state = true;

        } elseif ($request->filled('woman')) {
            $query->where('gender', $request->woman);
            $return_state = true;

        }

        // フリーワードのinputが存在し、かつ空でなければ
        if ($request->filled("free_word"))
        {
            $search_word = '%'.$free_word.'%';
            $query->where(function ($query) use ($search_word) {
                $query->where('name_sei', 'LIKE', $search_word);
                $query->where('name_mei', 'LIKE', $search_word);
                $query->orWhere('email', 'LIKE', $search_word);
            });
            $return_state = true;
        }

        if ($request->filled("sort_asc"))
        {
            $members = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
        }

        elseif($request->filled("sort_desc"))
        {
            $members = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;

        }
        else {
            $members = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
        }


        Log::debug($members);
        return view('admin.members.list')
            ->with([
                'members' => $members,
                'return_state' => $return_state,
                'asc_flg'=> $asc_flg,
                // 'id' => $id,
                'man' => $man,
                'woman' => $woman,
                'free_word' => $free_word,
                // 'return_product_category_id' => $product_category_id,
                // 'return_product_subcategory_id' => $product_subcategory_id,
            ]);
    }
}
