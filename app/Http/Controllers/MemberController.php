<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Member;
use Log;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    /**
     * 登録の確認画面へ
     */
    public function registerConf(MemberRequest $request)
    {
        Log::debug(config('master.gender'));

        if ($request->gender == 1)
        {
            $gender = config('master.gender.1');
        } else {
            $gender = config('master.gender.2');
        }

        return view('members.register_confirm')
            ->with(['registerMember' => $request->all(), 'gender' => $gender]);
    }

    /**
     * メンバを作成
     */
    public function registerMember(Request $request)
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
            ->route('registerCompPage');
    }

    public function login(Request $request)
    {

    }



}
