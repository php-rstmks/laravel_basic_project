<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Log;
use Illuminate\Support\Facades\Hash;


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

    public function registerpage()
    {
        $register = 'a';
        $edit = null;
        return view('admin.members.register', compact('register', 'edit'));
    }

    public function register_confpage(Request $request)
    {
        $register = 'a';
        $edit = null;
        $newmember = $request->all();
        return view('admin.members.register_conf', compact('register', 'edit', 'newmember'));

    }

    public function register(Request $request)
    {
        // 二重送信対策
        $request->session()->regenerateToken();

        Member::create([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.members.list');
    }


    public function editpage(Member $member)
    {
        $register = null;

        $edit = "a";
        Log::debug($member);
        return view('admin.members.edit')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'member' => $member,
            ]);
    }

    public function edit_confpage(Request $request, Member $member)
    {
        $register = null;
        $edit = "a";
        $editInfo = $request->all();
        return view('admin.members.register_conf', compact('register', 'edit', 'editInfo', $member));

    }

    public function edit(Request $request)
    {

    }



}
