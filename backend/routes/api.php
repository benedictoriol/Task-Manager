<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function(){
    // User routes
    Route::get('/user', function (Request $request) {
        return $request->user(); 
    });
    
    Route::resource('task', TaskController::class);
});