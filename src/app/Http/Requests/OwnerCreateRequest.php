<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OwnerCreateRequest extends FormRequest
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
        $rules = [
            'image' => ['required', 'image', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:100'],
            'area_id' => ['required'],
            'genre_id' => ['required'],
            'shop_overview' => ['required', 'string', 'max:150'],
            'price_name' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.required' => '画像を選択してください',
            'image.mimes' => 'アップロードできる画像は jpeg または png 形式です',
            'name.required' => '店舗名を入力してください',
            'area_id.required' => 'エリアを選択してください',
            'genre_id.required' => 'ジャンルを選択してください',
            'shop_overview.required' => '店舗概要を入力してください',
            'price_name.required' => 'メニュー名を入力してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '価格は数字で入力してください',
        ];
    }
}
