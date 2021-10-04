<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addressReq extends FormRequest
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
            'customerID'=>'required',
            'addressNo'=>'required',
            'addressLine1'=>'required|string|min:3|max:255',
            'addressLine2'=>'max:255',
            'city'=>'required|string|min:3|max:255',
            'state'=>'required|string|min:3|max:255',
            'postCode'=>'required|string|min:3|max:255',
            'country'=>'required|string|min:3|max:255',
        ];
    }

    /**
     * Custom message for validation
     * 
     * @return array
     */
    public function messages(){
        return [
            'addressLine1.required'=>'line 1 is required',
            'city.required'=>'city is required',
            'state.required'=>'state is required',
            'postCode.required'=>'postCode is required',
            'country.required'=>'country is required',
        ];
    }
}
