<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequestUpdate extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            // 'password'   => 'required',
            'phone'      => 'required'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'phone.required' => 'The Cell Field is required',
    //     ];
    // }
}
