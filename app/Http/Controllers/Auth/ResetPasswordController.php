<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Member;
use Log;
use Illuminate\Http\Request;
use Mail;
use App\Mail\PasswordReset;
use Hash;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function sendEmail(Request $request)
    {

        $to_mail_address = $request->input('email');

        $email = Member::where('email', '=', $request->email)->exists();

        $request->session()->put('update_password_for_email', $request->email);

        if (empty($email))
        {
            $request->session()->put('send_email', $request->email);
            return redirect()->back()->withErrors(['err_msg' => '入力されたメールアドレスは存在しません']);
        }

        Mail::to($to_mail_address)
            ->send(new PasswordReset($to_mail_address));

        return redirect()->route('sendEmailCompPage');

    }

    public function resetPassword(Request $request)
    {
        $request->validate(
        [
            'password' => 'required|between:8,20',
            'password_conf' => 'same:password',
        ],
        [
            'required' => 'パスワードは必須です。',
            'password_conf.same:password' => 'パスワードが一致しません',
            'password.between' => '8文字以上20文字以下でお願いします'
        ],
        [
            'password_conf' => 'パスワード確認',
        ]
        );

        $email = $request->session()->get('update_password_for_email');
        $request->session()->forget('update_password_for_email');

        Member::where('email', $email)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('topPage');
    }
}
