<?php

namespace App\Http\Controllers\Administer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberEditRequest;


class MemberController extends Controller
{
    public function showList(Request $request)
    {
        $members = Member::latest()->paginate(10);
        $asc_flg = false;

        // $id = $request->id;
        $man = $request->man;
        $woman = $request->woman;
        $free_word = $request->free_word;

        Log::debug($free_word);

        $query = Member::query();

        // return_stateをtrueにすることで、以下のコードに切り替えて
        // 検索条件にページネーションを適応させることができる。
        //{{ $members->appends(request()->query())->links('paginate.default') }}

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
            $search_word = '%' . $free_word . '%';
            Log::debug($search_word);
            $query->where(function ($whereQuery) use ($search_word) {
                $whereQuery->where('name_sei', 'LIKE', $search_word);
                $whereQuery->orWhere('name_mei', 'LIKE', $search_word);
                $whereQuery->orWhere('email', 'LIKE', $search_word);
            });
            $return_state = true;
        }

        if ($request->filled("sort_asc"))
        {
            $members = $query->orderBy('id', "ASC")->paginate(10);
            $asc_flg = true;
            $return_state = true;
        }

        elseif($request->filled("sort_desc"))
        {
            $members = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
            $return_state = true;

        }
        else {
            // 一覧ページでのデフォルトの場合に入る条件分岐
            // デフォルトでは降順
            $members = $query->orderBy('id', "DESC")->paginate(10);
            $asc_flg = false;
        }


        return view('admin.members.list')
            ->with([
                'members' => $members,
                'return_state' => $return_state,
                'asc_flg'=> $asc_flg,
                'man' => $man,
                'woman' => $woman,
                'free_word' => $free_word,
            ]);
    }

    public function registerpage()
    {
        $register = 'a';
        $edit = null;
        return view('admin.members.register', compact('register', 'edit'));
    }

    public function register_confpage(MemberRequest $request)
    {
        $register = 'a';
        $edit = null;
        $Info = $request->all();
        return view('admin.members.register_conf', compact('register', 'edit', 'Info'));

    }

    public function detailpage(Member $member)
    {
        return view('admin.members.detail')
            ->with(['member' => $member]);
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
        Log::debug('hen' . $member);

        $register = null;

        $edit = "a";
        return view('admin.members.edit')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'member' => $member,
            ]);
    }

    public function edit_confpage(MemberEditRequest $request, Member $member)
    {
        Log::debug('sen' . $member);

        $register = null;
        $edit = "a";
        $Info = $request->all();
        return view('admin.members.edit_conf')
            ->with([
                'register' => $register,
                'edit' => $edit,
                'Info' => $Info,
                'member' => $member,
            ]);
    }

    public function edit(Request $request, Member $member)
    {
        $member->name_sei = $request->name_sei;
        $member->name_mei = $request->name_mei;
        $member->nickname = $request->nickname;
        $member->gender = $request->gender;
        $member->password = Hash::make($request->password);
        $member->email = $request->email;

        $member->save();

        return redirect()
            ->route('admin.members.list');

    }

    public function delete(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.members.list');
    }



}
