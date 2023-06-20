<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProdutosRequest;
use App\Http\Resources\ProdutosCollection;
use App\Http\Resources\ProdutosResource;
use App\Models\Produtos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    public function index(): JsonResponse
    {
        $query = Produtos::query();
        $produtos = $query->paginate(5);
        $produtosListResource = new ProdutosCollection($produtos);

        return response()->json(
            $produtosListResource
        );
    }

    public function store(StoreUpdateProdutosRequest $request): JsonResponse
    {
        $imagemPath = $request->file('imagem')->store('public/produtos');
        $req = $request->all();
        $req['imagem'] = $imagemPath;

        return response()->json(
            ProdutosResource::make(Produtos::create($req)),
            201
        );
    }

    public function show(int $produtos): JsonResponse
    {
        return response()->json(
            ProdutosResource::make(Produtos::query()->findOrFail($produtos))
        );
    }

    public function update(int $produtos, StoreUpdateProdutosRequest $request): Response
    {
        $req = $request->all();
        $produtos = Produtos::query()->find($produtos);

        if ($produtos && isset($produtos->imagem)) {
            Storage::delete($produtos->imagem);
        }

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('public/produtos');
            $req['imagem'] = $imagemPath;
        }

        $produtos->update($req);

        return response()->noContent(201);
    }

    public function destroy(int $produtos): Response
    {
        Produtos::destroy($produtos);
        return response()->noContent();
    }
}
