<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePedidosRequest;
use App\Http\Resources\PedidosResource;
use App\Models\Pedidos;
use Illuminate\Http\Response;

class PedidosController extends Controller
{
    public function __construct(
        protected Pedidos $repository,
    ) {

    }

    public function index()
    {
        $pedidos = $this->repository->paginate();

        return PedidosResource::collection($pedidos);
    }

    public function store(StoreUpdatePedidosRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $pedidos = $this->repository->create($data);

        return new PedidosResource($pedidos);
    }

    public function show(string $id)
    {
        $pedido = $this->repository->findOrFail($id);

        return new PedidosResource($pedido);
    }

    public function update(StoreUpdatePedidosRequest $request, string $id)
    {
        $pedido = $this->repository->findOrFail($id);
        $data = $request->validated();
        $pedido->update($data);

        return new PedidosResource($pedido);
    }

    public function destroy(string $id)
    {
        $pedido = $this->repository->findOrFail($id);
        $pedido->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
