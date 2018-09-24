<?php

namespace ReclutaTI\Http\Requests\Front\Recruiter\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'puesto' => 'required',
            'descripcionBreve' => 'required|max:300',
            'descripcion' => 'required',
            'tipoDeVacante' => 'required|integer|exists:job_types,id',
            'estado' => 'required|integer|exists:states,id',
            'publicar' => 'required|integer|between:1,2',
            'salarioMinimo' => 'sometimes|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'salarioMaximo' => 'sometimes|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'nivelEducativo' => 'required|integer|exists:educative_levels,id'
        ];
    }

    public function messages()
    {
        return [
            'tipoDeVacante.integer' => 'El campo tipo de vacante es inválido.',
            'estado.integer' => 'El campo estado es inválido.',
            'publicar.integer' => 'El campo publicar es inválido.',
            'publicar.between' => 'El campo publicar es inválido.',
            'segunAptitudes.integer' => 'El campo segun aptitudes es inválido.',
            'segunAptitudes.between' => 'El campo segun aptitudes es inválido.',
            'nivelEducativo.integer' => 'El campo nivel educativo es inválido.'
        ];
    }
}
