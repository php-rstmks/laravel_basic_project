<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Member;
use Log;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use App\Mail\ChangeEmail;


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

    // 退会
    public function withdrawal()
    {
        Auth::user()->delete();

        return redirect()->route('topPage');
    }

    // 情報変更確認ページ
    public function changeInfoConfPage(Request $request)
    {
        Log::debug($request->name_mei);
        $request->validate([
            'name_sei' => 'required|string|max:20',
            'name_mei' => 'required|string|max:20',
            'nickname' => 'required|string|max:10',
            'gender' => 'required|in:1,2',
        ]);

        return view('members.info_change_conf')
            ->with(['changeInfo' => $request->all()]);
    }

    // 情報変更処理
    public function changeInfo(Request $request)
    {
        $member = Member::find(Auth::id());

        $member->name_sei = $request->name_sei;
        $member->name_mei = $request->name_mei;
        $member->gender = $request->gender;
        $member->nickname = $request->nickname;
        $member->save();

        return redirect()->route('myPage');
    }

    //
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|between:8,20',
            'password_conf' => 'required|regex:/^[a-zA-Z0-9]+$/|between:8,20|same:password',
        ]);

        $member = Member::find(Auth::id());

        $member->password = Hash::make($request->password);

        $member->save();

        return redirect()->route('myPage');
    }

    public function changeMailCode(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:200|unique:members'
        ],[
            'email.unique' => '入力されたメールアドレスはすでに登録されています。'
        ]);

        $code = random_int(10000,99999);

        $member = Member::find(Auth::id());
        $member->auth_code = $code;
        $member->save();

        $to_mail_address = $request->email;

        Mail::to($to_mail_address)
        ->send(new ChangeEmail($code));

        return view('members.change_mail_conf')
            ->with(['code' => $code, 'email' => $to_mail_address]);
    }

    public function changeEmail(Request $request)
    {
        //
        if (empty($request->code_from_email))
        {
            $request->session()->put('err_msg', '認証コードを入力してください');
            return redirect()->route('changeMemberMailPage');
        }

        // メールで送信したコードと一致している場合
        if ($request->code_original == $request->code_from_email)
        {
            $member = Member::find(Auth::id());
            $member->email = $request->email;
            $member->save();
        } else {
            $request->session()->put('err_msg', '認証コードが一致しません');

            return redirect()->route('changeMemberMailPage');
        }

        return redirect()->route('myPage');
    }
}
