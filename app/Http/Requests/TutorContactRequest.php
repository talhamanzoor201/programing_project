<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorContactRequest extends FormRequest
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
            'city_id' => 'required',
            'phone_number' => ['min:11', 'max:15', 'regex:/^[+#*\(\)\[\]]*([0-9][ ext+-pw#*\(\)\[\]]*){6,45}$/'],
        ];
    }


    public function messages()
    {
        return [
            'city_id.required' => 'Please select city.',
        ];

    }
}
