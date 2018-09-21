<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Dashboard\Settings;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'currentPassword' => 'required',
            'password' => 'required|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'currentPassword.required' => 'El campo contraseña actual es obligatorio.',
            'password.required' => 'El campo nueva contraseña es obligatorio.',
            'password.min' => 'El campo nueva contraseña debe contener al menos 8 carácteres.',
            'password.confirmed' => 'La confirmación del campo nueva contraseña es inválido.'
        ];
    }
}
