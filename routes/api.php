<?php

use App\Http\Controllers\Api\V1\ClientesController;
use App\Http\Controllers\Api\V1\PedidosController;
use App\Http\Controllers\Api\V1\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1'], function () {
    // CRUDL Clientes
    Route::prefix('clientes')->group(function () {
        Route::controller(ClientesController::class)->group(function () {
            Route::name('clientes.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::post('', 'store')->name('store');
                Route::put('/{id}', 'update')->name('update');
                Route::patch('/{id}', 'update')->name('update');
            });
        });
    });

    // CRUDL Produtos
    Route::prefix('produtos')->group(function () {
        Route::controller(ProdutosController::class)->group(function () {
            Route::name('produtos.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::post('', 'store')->name('store');
                Route::post('/{id}', 'update')->name('update');
                Route::put('/{id}', 'update')->name('update');
            });
        });
    });


    // CRUDL Pedidos
    Route::prefix('pedidos')->group(function () {
        Route::controller(PedidosController::class)->group(function () {
            Route::name('pedidos.')->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::post('', 'store')->name('store');
                Route::put('/{id}', 'update')->name('update');
                Route::patch('/{id}', 'update')->name('update');
                Route::get('{pedidos}/produtos', 'showProducts')->name('showProducts');
                Route::get('{pedidos}/clientes', 'showCostumers')->name('showCostumers');
            });
        });
    });
});
