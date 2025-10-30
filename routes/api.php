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
    
    // Workflow management
    Route::apiResource('workflows', App\Http\Controllers\Api\WorkflowController::class);
    Route::post('/workflows/{workflow}/execute', [App\Http\Controllers\Api\WorkflowController::class, 'execute']);
    Route::post('/workflows/{workflow}/sync-n8n', [App\Http\Controllers\Api\WorkflowController::class, 'syncToN8n']);
    
    // Script management
    Route::get('/scripts', [App\Http\Controllers\Api\ScriptController::class, 'index']);
    Route::post('/scripts', [App\Http\Controllers\Api\ScriptController::class, 'store']);
});

// n8n integration endpoints (UUID-based)
Route::get('/users/{user_uuid}/preferences', [App\Http\Controllers\Api\UserController::class, 'getPreferences'])->where('user_uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::post('/users/{user_uuid}/scripts', [App\Http\Controllers\Api\ScriptController::class, 'saveScript'])->where('user_uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::post('/trigger-generation', [App\Http\Controllers\Api\ScriptController::class, 'triggerGeneration']);

// n8n webhook endpoints (for n8n to send data back)
Route::post('/n8n/webhook/{user_id}', [App\Http\Controllers\Api\WorkflowController::class, 'receiveFromN8n']);
Route::post('/n8n/execution-result', [App\Http\Controllers\Api\WorkflowController::class, 'executionResult']);