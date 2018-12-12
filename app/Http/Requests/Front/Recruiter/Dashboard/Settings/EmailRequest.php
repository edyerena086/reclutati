<?php

namespace ReclutaTI\Http\Requests\Front\Recruiter\Dashboard\Settings;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'currentEmail' => 'required|email|exists:users,email',
            'newEmail' => 'required|email|unique:users,email,'.Auth::user()->id.',id',
            'password'=> 'required|min:8'
        ];
    }
}
