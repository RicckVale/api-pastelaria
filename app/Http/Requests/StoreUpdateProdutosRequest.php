<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProdutosRequest extends FormRequest
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
            'preco' => 'required|numeric',
            'imagem' => 'required|file|mimes:jpeg,png,|max:2048',
        ];

        if ($this->method() === 'PATCH') {
            $rules = [
            'nome' => 'sometimes|string|max:255',
            'preco' => 'sometimes|numeric',
            'imagem' => 'sometimes|file|mimes:jpeg,png,|max:2048',
            ];
        }

        return $rules;
    }
}
