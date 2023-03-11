<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'phone' => [
                'required',
                'regex:/(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/',
                'unique:users,phone'
            ],
            'email' => 'bail|required|string|email|max:255|unique:users',
            'password' => ['bail', 'required', 'string', 'confirmed', Password::min(4)->mixedCase()],
            'password' => 'required|string|confirmed|min:4|',

        ];

    }
}
