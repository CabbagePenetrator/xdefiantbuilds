<?php

use App\Http\Controllers\LoadoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [LoadoutController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::post('/loadouts', [LoadoutController::class, 'store'])
    ->name('loadouts.store')
    ->middleware('auth');

Route::get('/loadouts/{loadout}', [LoadoutController::class, 'show'])
    ->name('loadouts.show')
    ->middleware('auth');

Route::put('/loadouts/{loadout}', [LoadoutController::class, 'update'])
    ->name('loadouts.update')
    ->middleware('auth');

Route::delete('/loadouts/{loadout}', [LoadoutController::class, 'destroy'])
    ->name('loadouts.destroy')
    ->middleware('auth');

require __DIR__.'/auth.php';
