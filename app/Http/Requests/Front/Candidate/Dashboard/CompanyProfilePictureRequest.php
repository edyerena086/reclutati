<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfilePictureRequest extends FormRequest
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
            'imagenDePerfil' => 'required|image|max:2000|dimensions:max_width=1000.max_height=1000'
        ];
    }
}
