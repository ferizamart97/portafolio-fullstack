<?php

use  Illuminate\Http\Request ;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Rutas API
|--------------------------------------------------------------------------
|
|
Rutas API.
Estas rutas son cargadas por RouteServiceProvider dentro de un grupo al que
se le asigna el grupo de middleware "api".
|
*/

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/me', 'me');
        Route::post('/logout', 'logout');
    });

});
