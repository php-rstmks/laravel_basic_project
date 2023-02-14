<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;


use App\Product_category;
use Log;


class ProductRequest extends FormRequest
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
            'product_name' => 'required|max:100',
            'product_category_id' => 'integer|not_in:0',
            'product_subcategory_id' => 'integer|not_in:0|',
            'product_content' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です',
            'product_name.max' => '商品名は100文字以内で入力してください',
            'product_category_id.not_in' => 'カテゴリーを選択してください',
            'product_category_id.in' => 'カテゴリーを正しく選択してください',
            'product_category_id.integer' => 'カテゴリーを正しく選択してください',
            'product_category_id.between' => 'カテゴリーを正しく選択してください',
            'product_subcategory_id.not_in' => 'サブカテゴリーを選択してください',
            'product_subcategory_id.in' => 'サブカテゴリーを正しく選択してください',
            'product_subcategory_id.integer' => 'サブカテゴリーを正しく選択してください',
            'product_subcategory_id.between' => 'サブカテゴリーを正しく選択してください',
            'product_content.required' => '商品説明は必須です',
            'product_content.max' => '商品説明は500文字以内で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'product_category_id' => 'カテゴリ',
            'product_subcategory_id' => 'サブカテゴリ',
            'product_content' => '商品説明',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $categories = Product_category::whereNull('deleted_at')->pluck('id')->toArray();

        // 登録されているカテゴリIDに存在しないIDおよび文字列をinputフォームから入力した場合。
        $validator->sometimes('product_category_id', Rule::in($categories), function ($input) {
            return $input->product_category_id == true;
        });

        // 登録されているサブカテゴリIDに存在しないIDおよび文字列をinputフォームから入力した場合。
        if (!is_null($this->product_category_id)) {
            $category = Product_category::find($this->product_category_id);
            $subcategories = $category->product_subcategories()->pluck('id')->toArray();

            $validator->sometimes('product_subcategory_id', Rule::in($subcategories), function ($input) {
                return $input->product_category_id == true;
            });
        }


    }
}
