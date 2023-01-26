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
        return view('members.register_confirm')
            ->with('registerMember', $request->all());
    }

    public function registerMember(Request $request)
    {

        $gender = intval($request->gender);
        Log::debug(gettype($gender));

        Member::create([
            'name_sei' => $request->name_sei,
            'name_mei' => $request->name_mei,
            'nickname' => $request->nickname,
            'gender' => $gender,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);



        return redirect()
            ->route('registerCompPage');
    }
}
