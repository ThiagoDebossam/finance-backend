<?php

namespace App\Http\Requests;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdatePasswordRequest extends BaseRequest
{    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8|max:255|same:password_confirmation',
            'password_confirmation' => 'required|min:8|max:255',
            'old_password' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'password.same' => 'Senhas não conferem',
            'password.min' => 'O campo senha deve conter no mínimo 8 caracteres',
            'password_confirmation.required' => 'O campo confirme sua senha é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'old_password.required' => 'O campo senha atual é obrigatório',
            'password.max' => 'O campo senha deve conter no máximo 255 caracteres'
        ];
    }
}
