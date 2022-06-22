<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassifiedServiceRequest extends FormRequest
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
            'name_of_owner' => 'required',
            'dba'           => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'state'         => 'required',
            'zip'           => 'required',
            'phone_no'      => 'required',
            'cell_phone'    => 'required',
            'email'         => 'required',
        ];
    }
}
