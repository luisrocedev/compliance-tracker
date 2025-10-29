<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use App\Http\Controllers\Api\NormativaApiController;
use App\Http\Controllers\Api\DocumentoApiController;
use App\Http\Controllers\Api\AlertaApiController;
use App\Http\Controllers\Api\UserApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('normativas', NormativaApiController::class);
    Route::apiResource('documentos', DocumentoApiController::class);
    Route::apiResource('alertas', AlertaApiController::class);
    Route::apiResource('usuarios', UserApiController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
