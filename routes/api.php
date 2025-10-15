<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductorController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
//DECLARAR LAS RUTAS DE CATEGORIAS

Route::get('/consultar-todas-categoria',[CategoriaController::class, 'index']);
Route::get('/consultar-categoria/{categoria}',[CategoriaController::class, 'show']);
Route::post('/guardar-categoria',[CategoriaController::class, 'store']);
Route::put('/actualizar-categoria/{categoria}',[CategoriaController::class, 'update']);
Route::delete('/eliminar-categoria/{categoria}',[CategoriaController::class, 'destroy']);

//DECLARAR LAS RUTAS DE PRODUCTOS

Route::get('/consultar-todas-producto',[ProductorController::class, 'index']);
Route::get('/consultar-producto/{producto}',[ProductorController::class, 'show']);
Route::post('/guardar-producto',[ProductorController::class, 'store']);
Route::put('/actualizar-producto/{producto}',[ProductorController::class, 'update']);
Route::delete('/eliminar-producto/{producto}',[ProductorController::class, 'destroy']);