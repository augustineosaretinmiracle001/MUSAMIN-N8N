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
    Route::get('/settings/preferences', [App\Http\Controllers\SettingsController::class, 'preferences'])->name('settings.preferences');
    Route::post('/settings/preferences', [App\Http\Controllers\SettingsController::class, 'updatePreferences'])->name('settings.preferences.update');
    Route::get('/settings/api', [App\Http\Controllers\SettingsController::class, 'api'])->name('settings.api');
    Route::get('/settings/schedules', [App\Http\Controllers\SettingsController::class, 'schedules'])->name('settings.schedules');
    Route::get('/settings/account', [App\Http\Controllers\SettingsController::class, 'account'])->name('settings.account');
    
    // Script generation trigger
    Route::post('/generate-script', [App\Http\Controllers\Api\ScriptController::class, 'triggerGeneration'])->name('generate.script');
    
    // Scripts page
    Route::get('/scripts', [App\Http\Controllers\ScriptController::class, 'index'])->name('scripts');
    Route::get('/scripts/{script}', [App\Http\Controllers\ScriptController::class, 'show'])->name('scripts.show');
});

require __DIR__.'/auth.php';
