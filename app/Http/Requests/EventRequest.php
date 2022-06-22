<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'location' => 'required',
            'time' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'event_start_date' => 'required',
            'event_end_date' => 'required',
            'pay_per_day' => 'required',
        ];
    }
}
