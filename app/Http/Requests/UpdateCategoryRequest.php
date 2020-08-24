<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'slug' => 'required|max:100|unique:categories,slug',
            'description' => 'required|max:200',
            'feature_image' => 'max:200',
        ];
    }
}
