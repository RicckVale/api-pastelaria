<?php

use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\PedidosController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('/clientes', ClientesController::class);
Route::apiResource('/pedidos', PedidosController::class);
Route::apiResource('/produtos', ProdutosCon::class);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);
Route::patch('/clientes/{id}', [ClientesController::class, 'update']);
Route::get('/clientes/{id}', [ClientesController::class, 'show']);
Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
