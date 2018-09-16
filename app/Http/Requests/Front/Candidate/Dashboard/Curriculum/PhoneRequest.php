<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
            'celular' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
            'telefonoFijo' => 'sometimes|regex:/^[0-9\-\(\)\/\+\s]*$/'
        ];
    }

    public function messages()
    {
        return [
            'celular.regex' => 'El formato del celular no es válido.',
            'telefonoFijo.regex' => 'El formato del teléfono fijo no es válido.'
        ];
    }
}
