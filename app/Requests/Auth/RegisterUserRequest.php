<?php

namespace App\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email'          => 'required|email|unique:users,email',
            'firstname'      => 'required|min:1',
            'lastname'       => 'required|min:1',
            'country'        => 'required|min:1',
            'gender'         => 'required|min:1',
            'application_id' => 'required|exists:applications,id',
            'password'       => 'required|min:6',
        ];
    }
}
