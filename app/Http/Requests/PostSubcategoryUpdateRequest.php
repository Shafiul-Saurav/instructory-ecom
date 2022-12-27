<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSubcategoryUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pcategory_id' => 'required|numeric',
            'subcategory_name' => 'required|string|max:255',
            'pcategory_image' => 'nullable|image',
            // 'subcategory_image' => 'required|mimes:png,jpg,jpeg|max:512',
        ];
    }
}
