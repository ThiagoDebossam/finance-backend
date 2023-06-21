<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ExpensesAccountsMonthCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'year' => 'required|number',
            'account_id' => 'required|number'
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
            'name.required' => 'O campo ano é obrigatório',
            'name.year' => 'Ano inválido',
        ];
    }
}
