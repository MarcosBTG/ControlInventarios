<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return[
            'sku' => 'bail|required|unique:products',
            'name' => 'bail|required|max:100',
            'description' => 'required|max:250',
        ];
    }

    public function messages() {
        return[
            'sku.required' => 'El campo es obligatorio',
            'sku.unique' => 'El SKU ingresado ya existe!',
            'name.required' => 'El campo es obligatorio',
            'name.max' => 'El campo nombre solo puede contener hasta 100 caracteres',
            
            'description.required' => 'El campo es obligatorio',
            'description.max' => 'El campo nombre solo puede contener hasta 250 caracteres',
        ];
    }

}
