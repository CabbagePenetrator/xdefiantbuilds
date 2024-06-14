<?php

use App\Http\Controllers\CategoryLoadoutController;
use App\Http\Controllers\DownvoteLoadoutController;
use App\Http\Controllers\LoadoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpvoteLoadoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Loadouts
Route::get('/', [LoadoutController::class, 'index'])
    ->name('home');

Route::get('/loadouts/create', [LoadoutController::class, 'create'])
    ->name('loadouts.create')
    ->middleware('auth');

Route::post('/loadouts', [LoadoutController::class, 'store'])
    ->name('loadouts.store')
    ->middleware('auth');

Route::get('/loadouts/{loadout}', [LoadoutController::class, 'show'])
    ->name('loadouts.show');

Route::put('/loadouts/{loadout}', [LoadoutController::class, 'update'])
    ->name('loadouts.update')
    ->middleware('auth');

Route::delete('/loadouts/{loadout}', [LoadoutController::class, 'destroy'])
    ->name('loadouts.destroy')
    ->middleware('auth');

Route::post('/loadouts/{loadout}/upvote', UpvoteLoadoutController::class)
    ->name('upvote-loadout')
    ->middleware('auth');

Route::post('/loadouts/{loadout}/downvote', DownvoteLoadoutController::class)
    ->name('downvote-loadout')
    ->middleware('auth');

Route::get('/{category:name}/loadouts', [CategoryLoadoutController::class, 'index'])
    ->name('categories.loadouts');

require __DIR__.'/auth.php';
