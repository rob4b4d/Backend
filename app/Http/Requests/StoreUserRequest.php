<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Modify as per your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,subadmin,conductor',  // Validate only admin and subadmin roles
            'bus_num' => 'nullable|numeric',  // Bus number is optional and must be numeric
            'password' => [
                'required',
                Password::min(8)->letters(),  // Password must have at least 8 characters with letters
            ]
        ];
    }
}
