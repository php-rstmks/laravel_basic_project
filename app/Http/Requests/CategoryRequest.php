<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;



class CategoryRequest extends FormRequest
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
            'category_name' => ['required', 'max:20'],
            'subcategory_name.*' => ['nullable', 'max:20'],
        ];
    }

    public function attributes()
    {
        return [
            'category_name' => '商品大カテゴリ',
            'subcategory_name.*' => '商品小カテゴリ',
        ];
    }


}
