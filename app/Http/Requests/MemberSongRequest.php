<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberSongRequest extends FormRequest
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
            'title' => 'required',
            'label' => 'required',
            'artist' => 'required',
            'duration' => 'required',
            'lyrics' => 'required|mimes:txt,docx,text',
            'song' => 'required|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'terms_condition' => 'required'
        ];
    }
}
