<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'user_image' => 'nullable|image',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'upazila_id' => 'required|numeric',
            'address' => 'required|string',
            'gender' => 'nullable',
        ];
    }
}
