<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;
use ReclutaTI\Rules\Front\Candidate\CurrentEducation;

class EducationRequest extends FormRequest
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
            'institucionEducativa' => 'required',
            'nivelEducativo' => 'required|integer|exists:educative_levels,id',
            'tituloObtenido' => 'required',
            'estudiandoActualmente' => ['required', 'integer', 'between:1,2', new CurrentEducation]
        ];
    }

    public function messages()
    {
        return [
            'estudiandoActualmente.between' => 'El valor ingresado es inválido.'
        ];
    }
}
