<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EventRequest extends FormRequest
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
    public function rules(Request $request)
    {
    
        if( $request->hasFile('image') )
        {
            return [
                'name'             => 'required',
                'description'      => 'required',
                'image'            => 'required|mimes:jpg,jpeg,JPG,JPEG,bmp,png,PNG',
                'location'         => 'required',
                'time'             => 'required',
                'date_start'       => 'required',
                'date_end'         => 'required',
                'event_start_date' => 'required',
                'event_end_date'   => 'required',
                'pay_per_day'      => 'required',
            ];
        }
        else
        {
            return [
                'name'             => 'required',
                'description'      => 'required',
                'image'            => 'required',
                'location'         => 'required',
                'time'             => 'required',
                'date_start'       => 'required',
                'date_end'         => 'required',
                'event_start_date' => 'required',
                'event_end_date'   => 'required',
                'pay_per_day'      => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'date_start.required'    => 'The advertise start date field is is required',
            'date_end.required'      => 'The advertise end date field is required'
        ];
    }
}
