<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberEditRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name_sei' => ['required', 'string', 'max:20'],
            'name_mei' => ['required', 'string', 'max:20'],
            'nickname' => ['required', 'string', 'max:10'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'password' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9]+$/', 'between:8,20', 'confirmed'],
            'password_conf' => ['nullable', 'regex:/^[a-zA-Z0-9]+$/', 'required_with:password', 'string', 'between:8,20'],
            'email' => [
                'required',
                'string',
                'max:200',
                Rule::unique('members')->ignore($request->id, 'id'),
            ],

        ];
    }
}
