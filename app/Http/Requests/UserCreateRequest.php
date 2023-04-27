<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255',
            'email' => "required|email|unique:users,email,{$this->route('user')}",
            'password_confirmation' => 'required|min:8|max:255',
            'password' => 'required|min:8|max:255|same:password_confirmation',
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
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo e-mail é obrigatório',
            'password.required' => 'O campo senha é obrigatório',
            'password_confirmation.required' => 'O campo confirme sua senha é obrigatório',
            'name.min' => 'O campo nome deve conter no mínimo 5 caracteres',
            'password.min' => 'O campo senha deve conter no mínimo 8 caracteres',
            'name.max' => 'O campo nome deve conter no máximo 255 caracteres',
            'password.max' => 'O campo senha deve conter no máximo 255 caracteres',
            'email' => 'E-mail inválido',
            'email.unique' => 'E-mail em uso, tente outro.',
            'password.same' => 'Senhas não conferem'
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
