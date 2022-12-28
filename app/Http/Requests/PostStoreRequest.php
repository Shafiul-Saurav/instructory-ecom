<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'subcategory_id' => 'required|numeric',
            'post_name' => 'required|string|max:255',
            'post_description' => 'required|string|max:255',
            'long_description' => 'required|string',
            'post_image' => 'required|mimes:png,jpg,jpeg|max:512'
        ];
    }
}
