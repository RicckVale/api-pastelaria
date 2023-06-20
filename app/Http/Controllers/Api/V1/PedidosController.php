<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePedidosRequest;
use App\Http\Resources\PedidosCollection;
use App\Http\Resources\PedidosResource;
use App\Models\Pedidos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PedidosController extends Controller
{
    public function index()
    {
        $query = Pedidos::query();
        $pedidos = $query->paginate(5);
        $pedidosListResource = new PedidosCollection($pedidos);

        return response()->json(
            $pedidosListResource
        );
    }

    public function store(StoreUpdatePedidosRequest $request): JsonResponse
    {
        $pedido = new Pedidos();
        $pedido->codigo_do_cliente = $request->input('codigo_do_cliente');
        $pedido->codigo_do_produto = $request->input('codigo_do_produto');
        $pedido->save();

        return response()->json(['message' => 'Pedido criado com sucesso'], 201);
    }

    public function show(int $pedidos): JsonResponse
    {
        return response()->json(
            PedidosResource::make(
                Pedidos::query()->findOrFail($pedidos)
            )
        );
    }

    public function update(int $pedidos, StoreUpdatePedidosRequest $request)
    {
        Pedidos::query()->find($pedidos)->update($request->all());

        return response()->json(
            PedidosResource::make(
                Pedidos::query()->findOrFail($pedidos)
            ),
            201
        );
    }

    public function destroy(int $pedidos): Response
    {
        Pedidos::destroy($pedidos);
        return response()->noContent();
    }

    public function showProducts(Pedidos $pedidos)
    {
        $produtos = $pedidos->produtos;
        return response()->json($produtos);
    }

    public function showCostumers(Pedidos $pedidos)
    {
        $clientes = $pedidos->clientes;
        return response()->json($clientes);
    }
}
