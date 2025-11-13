<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultorioController; 
use App\Http\Controllers\MedicoController;      

// =========================================================
// 1. RUTAS PÚBLICAS (Login y Register)
// ESTAS RUTAS SON ACCESIBLES SIN NECESIDAD DE TOKEN.
// =========================================================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// =========================================================
// 2. RUTAS PROTEGIDAS (Requieren Token JWT)
// Todas las rutas aquí dentro DEBEN tener un token válido.
// =========================================================

Route::middleware('auth:api')->group(function () {
    
    // Autenticación Protegida (Cerrar sesión y obtener datos del usuario)
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Recursos de la Aplicación (CRUD completo)
    // Usamos apiResource para generar todas las rutas RESTful necesarias
    Route::apiResource('users', UserController::class); 
    // CRUD para Consultorios
    Route::apiResource('consultorios', ConsultorioController::class);
    // CRUD para Médicos
    Route::apiResource('medicos', MedicoController::class); 
});