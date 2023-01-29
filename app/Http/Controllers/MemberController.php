<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Member;
use Log;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    public function registerConf(MemberRequest $request)
    {
        if ($request->gender == 1)
        {
            $gender = "男性";
        } else {
            $gender = "女性";
        }

        return view('members.register_confirm')
            ->with(['registerMember' => $request->all(), 'gender' => $gender]);
    }

    public function registerMember(Request $request)
    {
        Log::debug(config('master.gender'));

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
