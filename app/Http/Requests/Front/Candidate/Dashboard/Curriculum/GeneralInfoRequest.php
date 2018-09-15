<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInfoRequest extends FormRequest
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
            'primerNombre' => 'required|string',
            'segundoNombre' => 'sometimes|string',
            'apellidoPaterno' => 'required|string',
            'apellidoMaterno' => 'sometimes|string',
            'edad' => 'sometimes|integer|between:16,85',
            'genero' => 'sometimes|integer|exists:genders,id'
        ];
    }

    public function messages()
    {
        return [
            'edad.between' => 'Debes de tener entre 16 y 85 años de edad.'
        ];
    }
}
