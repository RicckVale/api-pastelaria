<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientesRequest;
use App\Http\Resources\ClientesCollection;
use App\Http\Resources\ClientesResource;
use App\Models\Clientes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientesController extends Controller
{

    public function index(): JsonResponse
    {
        $query = Clientes::query();
        $clientes = $query->paginate(5);
        $clientesListResource = new ClientesCollection($clientes);

        return response()->json(
            $clientesListResource
        );
    }

    public function store(StoreUpdateClientesRequest $request): JsonResponse
    {
        return response()->json(
            ClientesResource::make(Clientes::create($request->all())),
            201
        );
    }

    public function show(int $clientes): JsonResponse
    {
        return response()->json(
            ClientesResource::make(Clientes::query()->findOrFail($clientes))
        );
    }

    public function update(int $clientes, Request $request): JsonResponse
    {
        Clientes::query()->find($clientes)->update($request->all());

        return response()->json(
            ClientesResource::make(
                Clientes::query()->findOrFail($clientes)
            ),
            201
        );
    }

    public function destroy(int $clientes): Response
    {
        Clientes::destroy($clientes);
        return response()->noContent();
    }
}
