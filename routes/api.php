<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultorioController; // Importar
use App\Http\Controllers\MedicoController;      // Importar 



// ... otros imports

// Definición de rutas RESTful
Route::middleware('auth:api')->resource('users', UserController::class); 
// Esto crea las 5 rutas (index, store, show, update, destroy)

// Define las rutas RESTful de manera compacta para usuarios
Route::middleware('auth:api')->resource('users', UserController::class);

// Puedes hacer lo mismo para los otros recursos:
Route::middleware('auth:api')->resource('consultorios', ConsultorioController::class);
Route::middleware('auth:api')->resource('medicos', MedicoController::class);


Route::middleware('auth:api')->group(function () {
    // Rutas protegidas (Controller -> Service -> Repository)
    Route::resource('users', UserController::class);
    Route::resource('consultorios', ConsultorioController::class);
    Route::resource('medicos', MedicoController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con JWT
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

});

Route::middleware('auth:api')->group(function () {
    // Estas rutas usan los controladores recién creados
    Route::resource('users', UserController::class);
    Route::resource('consultorios', ConsultorioController::class);
    Route::resource('medicos', MedicoController::class);
});