<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    public function registrationConf(Request $request)
    {
        return view('members.register_confirm')
            ->with('registerMember', $request->all());
    }
}
