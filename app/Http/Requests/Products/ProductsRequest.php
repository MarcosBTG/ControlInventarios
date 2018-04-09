<?php

namespace App\Http\Requests\Products;

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
            'sku' => 'bail|required|min:5|max:100|unique:products',
            'name' => 'bail|required|max:100',
            'description' => 'max:250',
        ];
    }

    public function messages() {
        return[
            'sku.required' => ' El campo es obligatorio',
            'sku.unique' => ' Este c&oacute;digo SKU no puede ser utilizado!',
            'sku.min' => ' El campo SKU solo puede contener minimo 5 caracteres',
            'sku.max' => ' El campo SKU solo puede contener m&aacute;ximo hasta 30 caracteres',
            'name.required' => ' El campo es obligatorio',
            'name.max' => ' El campo nombre solo puede contener hasta 100 caracteres',

            'description.max' => ' El campo descripci&oacute; solo puede contener un m&aacute;ximo de hasta 250 caracteres',
        ];
    }

}
