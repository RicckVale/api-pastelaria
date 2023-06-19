<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientesRequest;
use App\Http\Resources\ClientesResource;
use App\Models\Clientes;
use Illuminate\Http\Response;

class ClientesController extends Controller
{
    public function __construct(
        protected Clientes $repository,
    ) {

    }

    public function index()
    {
        $clientes = $this->repository->paginate();

        return ClientesResource::collection($clientes);
    }

    public function store(StoreUpdateClientesRequest $request)
    {
        $data = $request->validated();
        $cliente = $this->repository->create($data);

        return new ClientesResource($cliente);
    }

    public function show(string $id)
    {
        $cliente = $this->repository->findOrFail($id);

        return new ClientesResource($cliente);
    }

    public function update(StoreUpdateClientesRequest $request, string $id)
    {
        $cliente = $this->repository->findOrFail($id);
        $data = $request->validated();
        $cliente->update($data);

        return new ClientesResource($cliente);
    }

    public function destroy(string $id)
    {
        $cliente = $this->repository->findOrFail($id);
        $cliente->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
