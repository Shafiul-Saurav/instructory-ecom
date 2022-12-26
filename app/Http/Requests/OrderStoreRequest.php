<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255',
            'phone' => [
                'required',
                'regex:/(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/',
            ],
            'district_id' => 'required|numeric',
            'upazila_id' => 'required|numeric',
            'address' => 'required|string',
            'order_note' => 'nullable|string',
        ];
    }
}
