<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings routes
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/preferences', [App\Http\Controllers\SettingsController::class, 'updatePreferences'])->name('settings.preferences');
    
    // Script generation trigger
    Route::post('/generate-script', [App\Http\Controllers\Api\ScriptController::class, 'triggerGeneration'])->name('generate.script');
    
    // Scripts page
    Route::get('/scripts', [App\Http\Controllers\ScriptController::class, 'index'])->name('scripts');
    Route::get('/scripts/{script}', [App\Http\Controllers\ScriptController::class, 'show'])->name('scripts.show');
    Route::delete('/scripts/{script}', [App\Http\Controllers\ScriptController::class, 'destroy'])->name('scripts.destroy');
});

require __DIR__.'/auth.php';
