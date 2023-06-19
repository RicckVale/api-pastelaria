<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string|max:20',
            'nascimento' => 'required|date',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
        ];

        if ($this->method() === 'PATCH') {
            $rules = [
                'nome' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:clientes',
                'telefone' => 'sometimes|string|max:20',
                'nascimento' => 'sometimes|date',
                'rua' => 'sometimes|string|max:255',
                'numero' => 'sometimes|string|max:255',
                'complemento' => 'nullable|string|max:255',
                'bairro' => 'sometimes|string|max:255',
                'cep' => 'sometimes|string|max:10',
                'data_de_cadastro' => 'sometimes|date',
            ];
        }
        return $rules;
    }
}
