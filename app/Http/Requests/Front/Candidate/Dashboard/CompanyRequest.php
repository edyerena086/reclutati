<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'empresa' => 'required',
            'telefono' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
        ];
    }

    public function messages()
    {
        return [
            'telefono.regex' => 'El formato de teléfono es inválido.'
        ];
    }
}
