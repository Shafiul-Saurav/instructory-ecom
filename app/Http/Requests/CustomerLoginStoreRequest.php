<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginStoreRequest extends FormRequest
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
            'email' => 'bail|required|string|email|max:255|',
            'password' => ['bail', 'required', 'string'],
        ];
    }
}
