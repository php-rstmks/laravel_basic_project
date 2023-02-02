<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Administer;
use Hash;


class AdministerController extends Controller
{
    use AuthenticatesUsers;

    public function regist(Request $request)
    {
        Administer::create([
            'name' => $request->name,
            'login_id' => $request->login_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('adminLoginPage');
    }

    public function __construct()
    {
        $this->middleware('guest:administer')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('administer');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|max:10',
            'password' => 'required|string|alpha_num|between:8,20',
        ]);
    }

    protected $redirectTo = '/admin-home';


    public function username()
    {
        return 'login_id';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/admin-login-page');
    }
}
