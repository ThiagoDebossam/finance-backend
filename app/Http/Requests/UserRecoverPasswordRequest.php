<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRecoverPasswordRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            'password' => 'required|min:8|max:255|same:password_confirmation',
            'password_confirmation' => 'required|min:8|max:255',
            'token' => 'required'
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
            'token.required' => 'Erro de token',
            'password.max' => 'O campo senha deve conter no máximo 255 caracteres'
        ];
    }

    public function failedValidation(Validator $validator) 
    { 
        throw new HttpResponseException(response()->json([ 
            'success' => false, 
            'message' => 'Erros de validação', 
            'data' => $validator->errors() 
        ], 422)); 
    }
}
