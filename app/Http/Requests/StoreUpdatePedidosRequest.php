<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePedidosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'codigo_do_cliente' => 'required|exists:clientes,id',
            'codigo_do_produto' => 'required|exists:produtos,id',
        ];

        if ($this->method() === 'PATCH') {
            $rules = [
                'codigo_do_cliente' => 'sometimes|exists:clientes,id',
                'codigo_do_produto' => 'sometimes|exists:produtos,id',
            ];
        }


        return $rules;
    }
}
