<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_sei' => 'required|string|max:20',
            'name_mei' => 'required|string|max:20',
            'nickname' => 'required|string|max:10',
            'gender' => 'required|in:1,2',
            'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
            'password_conf' => 'same:password',
            'email' => 'required|string|max:200|email|unique:members'
        ];
    }

    public function attributes()
    {
        return [
            'name_sei' => '氏名（姓）',
            'name_mei' => '氏名（名）',
            'nickname' => 'ニックネーム',
            'gender' => '性別',
            'password' => 'パスワード',
            'password_conf' => 'パスワードの確認',
            'email' => 'メールアドレス'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'パスワードは半角英数字のみでお願いします。',
        ];
    }
}
