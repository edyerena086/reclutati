<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'calle' => 'required',
            'numeroExterior' => 'required',
            'colonia' => 'required',
            'ciudad' => 'required',
            'estado' => 'required|integer|exists:states,id',
            'codigoPostal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'estado.integer' => 'El campo estado es inválido.'
        ];
    }
}
