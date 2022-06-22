<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberSettingRequest extends FormRequest
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
            // 'membership_type_id' => 'required',
            // 'photo' => 'required',
            // 'video' => 'required',
            // 'song' => 'required',
            // 'instrument' => 'required',
            // 'full_access' => 'required',
            // 'home_access' => 'required',
            // 'about_us' => 'required',
            // 'view_event' => 'required',
            // 'post_event' => 'required',
            // 'request_to_book_band' => 'required',
            // 'post_classified' => 'required',
            // 'view_classified' => 'required',
            // 'cd_store' => 'required',
            // 'cd_sell' => 'required',
            // 'musian_search' => 'required',
            // 'radio_submit' => 'required',
            // 'radio_listen' => 'required',
            // 'contact_us' => 'required',
            'sign_up_fee' => 'required',
            'sign_up_fee_duration' => 'required',
            'number_of_song_upload' => 'required',
        ];
    }
}
