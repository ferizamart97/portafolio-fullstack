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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login',   [AuthController::class, 'login']);
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me',      [AuthController::class, 'me']);
});
