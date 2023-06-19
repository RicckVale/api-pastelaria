<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProdutosRequest;
use App\Http\Resources\ProdutosResource;
use App\Models\Produtos;
use Illuminate\Http\Response;

class ProdutosController extends Controller
{
    public function __construct(
        protected Produtos $repository,
    ) {

    }

    public function index()
    {
        $produtos = $this->repository->paginate();

        return ProdutosResource::collection($produtos);
    }

    public function store(StoreUpdateProdutosRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $produtos = $this->repository->create($data);

        return new ProdutosResource($produtos);
    }

    public function show(string $id)
    {
        $produto = $this->repository->findOrFail($id);

        return new ProdutosResource($produto);
    }

    public function update(StoreUpdateProdutosRequest $request, string $id)
    {
        $produto = $this->repository->findOrFail($id);
        $data = $request->validated();
        $produto->update($data);

        return new ProdutosResource($produto);
    }

    public function destroy(string $id)
    {
        $produto = $this->repository->findOrFail($id);
        $produto->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
