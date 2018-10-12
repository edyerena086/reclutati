<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePictureRequest extends FormRequest
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
            'imagenDePerfil' => 'required|image|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'imagenDePerfil.max' => 'Tu imagen de perfil debe pesar menos de un 1 MB',
            'imagenDePerfil.dimensions' => 'Las dimensiones de la imagen no deben superar los 400px.'
        ];
    }
}
