<?php

namespace App\Http\Requests\Containers;

use Illuminate\Foundation\Http\FormRequest;

class ContainersRequest extends FormRequest
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
    public function rules() {
        return[
            'select_ubication' => 'bail|required|max:2',
        ];
    }

    public function messages() {
        return[
            'select_ubication.required' => 'El campo es obligatorio',
            'select_ubication.max' => 'Este campo solo acepta un m&aacute;ximo de 2 caracteres',
        ];
    }
}
