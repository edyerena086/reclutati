<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Account;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'password' => 'required|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'El campo nueva contraseña es obligatorio.',
            'password.min' => 'El campo nueva contraseña debe contener al menos 8 carácteres.',
            'password.confirmed' => 'La confirmación del campo nueva contraseña es inválida.'
        ];
    }
}
