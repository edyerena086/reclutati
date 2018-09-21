<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;
use ReclutaTI\Rules\Front\Candidate\CurrentJobHistory;

class JobHistoryRequest extends FormRequest
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
            'puesto' => 'required',
            'duracion' => 'required|numeric',
            'descripcion' => 'required',
            'trabajoActual' => ['required', 'integer', 'between:1,2', new CurrentJobHistory(($this->jobHistoryId != null) ? $this->jobHistoryId : 0)]
        ];
    }

    public function messages()
    {
        return [
            'trabajoActual.between' => 'El campo trabajo actual es inválido.'
        ];
    }
}
