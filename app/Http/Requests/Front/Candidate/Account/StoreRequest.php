<?php

namespace ReclutaTI\Http\Requests\Front\Candidate\Account;

use Illuminate\Foundation\Http\FormRequest;

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
            'nombre' => 'required|string',
            'apellidoPaterno' => 'required|string',
            'correoElectronico' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];
    }
}
