<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'idioma' => 'required|integer|exists:languages,id',
            'porcentaje' => 'required|integer|between:1,100'
        ];
    }

    public function messages()
    {
        return [
            'porcentaje.between' => 'El porcentaje debe de estar en 1 y 100.'
        ];
    }
}
