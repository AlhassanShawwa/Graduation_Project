<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
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
            'insurance_code' => 'required',
            'discount_percentage' =>'required|numeric',
            'Company_rate' =>'required|numeric',
            'name' => 'required|unique:insurance_translations,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'insurance_code.required' => __('validation.required'),
            'discount_percentage.required' => __('validation.required'),
            'discount_percentage.numeric' => __('validation.numeric'),
            'Company_rate.required' => __('validation.required'),
            'Company_rate.numeric' => __('validation.numeric'),
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
        ];
    }
}
