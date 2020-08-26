<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'         => 'required|max:100',
            // 'slug'          => 'required|max:100|unique:articles,slug',
            'description'   => 'required|max:200',
            'content'       => 'required',
            'category_id'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => "The category field is required."
        ];
    }
}
