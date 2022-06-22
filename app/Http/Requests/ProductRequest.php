<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->route()->getName() == 'classified.sell.post'){
            return [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
                'model' => 'required',
                'price' => 'required',
                'quantity' => 'required'
            ];  
        }

        if(request()->route()->getName() == 'cd-sell.post'){
            return [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
                'model' => 'required',
                'price' => 'required',
                'quantity' => 'required'
            ];  
        }
        
        return [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            // 'meta_tag_title' => 'required',
            'model' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            // 'sort_order' => 'required'
        ];
    }
}
