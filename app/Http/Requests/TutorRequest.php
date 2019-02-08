<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
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
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'institute' => 'required',
            'degree_title' => 'required',
            'avatar' => 'image | max:1024',
        ];
    }


    public function messages()
    {
        return [
            'degree_title.required' => 'Degree Name is required.',
            'name.regex' => 'The name may only contain letters and space',
            'institute.required' => 'Institute Name is required.',
            'avatar.max' => 'The Image may not be greater than 1Mb.'
        ];

    }
}
