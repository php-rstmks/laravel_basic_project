<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ReviewRequest extends FormRequest
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
            'evaluation' => ['required', Rule::in([1, 2, 3, 4, 5])],
            'comment' => ['required', 'max:500'],
        ];
    }

    public function attributes()
    {
        return [
            'evaluation' => '商品評価',
            'comment' => '商品コメント',
        ];
    }
}
