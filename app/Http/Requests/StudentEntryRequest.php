<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentEntryRequest extends FormRequest
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
            "name" => "required",
            "dob"  => "required",
            'phone' => 'required|unique:users,phone',
            'zip' => 'required',
            'roll' => 'required',
            'add' => 'required',
            'brnch' => 'required',
            'gender' => 'required',
            'image' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'phone.unique' => 'This phone number is already registered.',
        ];
    }
}
