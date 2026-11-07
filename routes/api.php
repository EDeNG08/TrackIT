<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DepartamentoApiController;

// 1. Ruta publica para iniciar sesion y obtener el token de acceso
Route::post('/login', [AuthApiController::class, 'login']);
// 2. Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // 3. Ruta para obtener los datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Endpoints 
    Route::apiResource('categorias', CategoriaApiController::class);
    Route::apiResource('departamentos', DepartamentoApiController::class);
});
