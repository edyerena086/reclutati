<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'resume' => 'required|mimes:pdf|max:2000'
        ];
    }

    public function messages()
    {
        return [
            'resume.max' => 'Tu CV no debe de pesar más de 2 MB.'
        ];
    }
}
