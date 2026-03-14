<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required','string','max:255'],
            'tagline' => ['nullable','string','max:255'],
            'overview' => ['nullable','string'],
            'description' => ['nullable','string'],
            'icon' => ['nullable','string'],
            'featured_image' => ['nullable','string'],
            'meta_title' => ['nullable','string'],
            'meta_description' => ['nullable','string'],
            'order' => ['nullable','integer'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ];
    }
}