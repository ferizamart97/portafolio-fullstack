<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProjectPublicController;

Route::prefix('public')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // rutas protegidas
        Route::get('/projects', [ProjectPublicController::class, 'index']);
    });



});

