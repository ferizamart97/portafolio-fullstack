<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\SolutionTypeController;
use App\Http\Controllers\IndutryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\WorkModeController;




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


    // Rutas CRUD para education
    // GET    /education
    Route::get('/education', [EducationController::class, 'index']);

    // GET    /education/{id}
    Route::get('/education/{id}', [EducationController::class, 'show']);

    // POST   /education
    Route::post('/education', [EducationController::class, 'store']);

    // PUT    /education/{id}
    Route::put('/education/{id}', [EducationController::class, 'update']);

    // PATCH  /education/{id}
    Route::patch('/education/{id}', [EducationController::class, 'updatePartial']);

    // DELETE /education/{id}
    Route::delete('/education/{id}', [EducationController::class, 'destroy']);


    // Rutas CRUD para solutionType
    // GET    /solutionType
    Route::get('/solutionType', [SolutionTypeController::class, 'index']);

    // GET    /solutionType/{id}
    Route::get('/solutionType/{id}', [SolutionTypeController::class, 'show']);

    // POST   /solutionType
    Route::post('/solutionType', [SolutionTypeController::class, 'store']);

    // PUT    /solutionType/{id}
    Route::put('/solutionType/{id}', [SolutionTypeController::class, 'update']);

    // PATCH  /solutionType/{id}
    Route::patch('/solutionType/{id}', [SolutionTypeController::class, 'updatePartial']);

    // DELETE /solutionType/{id}
    Route::delete('/solutionType/{id}', [SolutionTypeController::class, 'destroy']);


    // Rutas CRUD para industry
    // GET    /industry
    Route::get('/industry', [IndutryController::class, 'index']);

    // GET    /industry/{id}
    Route::get('/industry/{id}', [IndutryController::class, 'show']);

    // POST   /industry
    Route::post('/industry', [IndutryController::class, 'store']);

    // PUT    /industry/{id}
    Route::put('/industry/{id}', [IndutryController::class, 'update']);

    // PATCH  /industry/{id}
    Route::patch('/industry/{id}', [IndutryController::class, 'updatePartial']);

    // DELETE /industry/{id}
    Route::delete('/industry/{id}', [IndutryController::class, 'destroy']);


    // Rutas CRUD para testimonial
    // GET    /testimonial
    Route::get('/testimonial', [TestimonialController::class, 'index']);

    // GET    /testimonial/{id}
    Route::get('/testimonial/{id}', [TestimonialController::class, 'show']);

    // POST   /testimonial
    Route::post('/testimonial', [TestimonialController::class, 'store']);

    // PUT    /testimonial/{id}
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update']);

    // PATCH  /testimonial/{id}
    Route::patch('/testimonial/{id}', [TestimonialController::class, 'updatePartial']);

    // DELETE /testimonial/{id}
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy']);


    // Rutas CRUD para experience
    // GET    /experience
    Route::get('/experience', [ExperienceController::class, 'index']);

    // GET    /experience/{id}
    Route::get('/experience/{id}', [ExperienceController::class, 'show']);

    // POST   /experience
    Route::post('/experience', [ExperienceController::class, 'store']);

    // PUT    /experience/{id}
    Route::put('/experience/{id}', [ExperienceController::class, 'update']);

    // PATCH  /experience/{id}
    Route::patch('/experience/{id}', [ExperienceController::class, 'updatePartial']);

    // DELETE /experience/{id}
    Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);


    // Rutas CRUD para tool
    // GET    /tool
    Route::get('/tool', [ToolController::class, 'index']);

    // GET    /tool/{id}
    Route::get('/tool/{id}', [ToolController::class, 'show']);

    // POST   /tool
    Route::post('/tool', [ToolController::class, 'store']);

    // PUT    /tool/{id}
    Route::put('/tool/{id}', [ToolController::class, 'update']);

    // PATCH  /tool/{id}
    Route::patch('/tool/{id}', [ToolController::class, 'updatePartial']);

    // DELETE /tool/{id}
    Route::delete('/tool/{id}', [ToolController::class, 'destroy']);


    // Rutas CRUD para workMode
    // GET    /workMode
    Route::get('/workMode', [WorkModeController::class, 'index']);

    // GET    /workMode/{id}
    Route::get('/workMode/{id}', [WorkModeController::class, 'show']);

    // POST   /workMode
    Route::post('/workMode', [WorkModeController::class, 'store']);

    // PUT    /workMode/{id}
    Route::put('/workMode/{id}', [WorkModeController::class, 'update']);

    // PATCH  /workMode/{id}
    Route::patch('/workMode/{id}', [WorkModeController::class, 'updatePartial']);

    // DELETE /workMode/{id}
    Route::delete('/workMode/{id}', [WorkModeController::class, 'destroy']);
});
