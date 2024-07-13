<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupOfServicesRequest extends FormRequest
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
            'name' => 'required|unique:service_translations,name,'.$this->id.',Service_id',
            'price' => 'numeric|required',
            'GroupsItems'=> 'required|,name',
            'discount_value' => 'numeric|required',
            'taxes' => 'numeric|required',
            'name_group' => 'name|required',
            'notes'=> 'required|name',




        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'notes.required' => __('validation.required'),
            'name_group.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'price.required' => __('validation.required'),
            'price.numeric' => __('validation.numeric'),
        ];
    }
}
