<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'unique:users',
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'password' => ['min:6', 'confirmed',
                'regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/'],
            'city_id' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'name.regex' => 'The name may only contain letters and space',
            'password.regex' => ' Must contain one digit.',
            'city_id.required' => 'Please select City.'
        ];

    }
}
