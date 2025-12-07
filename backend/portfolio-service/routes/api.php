<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CertificationController;


use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {

    // Solo entra si manda un JWT válido en Authorization: Bearer <token>
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}',   [ProjectController::class, 'show']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::patch('/projects/{id}', [ProjectController::class, 'updatePartial']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    // Rutas CRUD para skills
    // GET    /skills
    Route::get('/skills', [SkillController::class, 'index']);

    // GET    /skills/{id}
    Route::get('/skills/{id}', [SkillController::class, 'show']);

    // POST   /skills
    Route::post('/skills', [SkillController::class, 'store']);

    // PUT    /skills/{id}
    Route::put('/skills/{id}', [SkillController::class, 'update']);

    // DELETE /skills/{id}
    Route::delete('/skills/{id}', [SkillController::class, 'destroy']);

    // Rutas CRUD para certification
    // GET    /certification
    Route::get('/certification', [CertificationController::class, 'index']);

    // GET    /certification/{id}
    Route::get('/certification/{id}', [CertificationController::class, 'show']);

    // POST   /certification
    Route::post('/certification', [CertificationController::class, 'store']);

    // PUT    /certification/{id}
    Route::put('/certification/{id}', [CertificationController::class, 'update']);

    // PATCH  /certification/{id}
    Route::patch('/certification/{id}', [CertificationController::class, 'updatePartial']);

    // DELETE /certification/{id}
    Route::delete('/certification/{id}', [CertificationController::class, 'destroy']);
});
