<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IaPredictionController;

Route::middleware('auth')->group(function () {
    Route::get('/ia-prediccion/normativa/{id}', [IaPredictionController::class, 'normativa']);
    Route::get('/ia-prediccion/documento/{id}', [IaPredictionController::class, 'documento']);
});
