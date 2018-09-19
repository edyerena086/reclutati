<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum\Language;

use Illuminate\Foundation\Http\FormRequest;
use ReclutaTI\Rules\Front\Candidate\UniqueLanguage;

class StoreRequest extends FormRequest
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
            'idioma' => ['required', 'integer', 'exists:languages,id', new UniqueLanguage(0)],
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
