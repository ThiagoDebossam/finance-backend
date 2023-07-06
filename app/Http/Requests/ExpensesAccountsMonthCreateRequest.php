<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ExpensesAccountsMonthCreateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'year' => 'required|max:4|min:4',
            'account_id' => 'required|exists:accounts,id',
            'month_id' => 'required|exists:lookup_months,id',
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
            'year.required' => 'O campo ano é obrigatório',
            'year.max' => 'Ano inválido',
            'year.min' => 'Ano inválido',
            'account_id.required' => 'O campo conta é obrigatório',
            'month_id.required' => 'O campo mês é obrigatório',
            'month_id.exists' => 'Mês inválido',
            'account_id.exists' => 'Conta inválida',
        ];
    }
}
