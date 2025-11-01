<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/profile', [App\Http\Controllers\Api\AuthController::class, 'profile']);
    
    // Script management
    Route::get('/scripts', [App\Http\Controllers\Api\ScriptController::class, 'index']);
    Route::post('/scripts', [App\Http\Controllers\Api\ScriptController::class, 'store']);
    Route::get('/scripts/{script}', [App\Http\Controllers\Api\ScriptController::class, 'show']);
});

// Token generation (web auth)
Route::middleware('web', 'auth')->group(function () {
    Route::post('/generate-token', [App\Http\Controllers\SettingsController::class, 'generateToken']);
});

// n8n integration endpoints (secured with API key)
Route::middleware('n8n.auth')->group(function () {
    Route::get('/users/{user_uuid}/preferences', [App\Http\Controllers\Api\UserController::class, 'getPreferences']);
    Route::post('/users/{user_uuid}/scripts', [App\Http\Controllers\Api\ScriptController::class, 'saveScript']);
    Route::post('/n8n/save-script', [App\Http\Controllers\Api\ScriptController::class, 'saveScriptFromN8n']);
    Route::post('/trigger-generation', [App\Http\Controllers\Api\ScriptController::class, 'triggerGeneration']);
});

