<?php

use App\Http\Controllers\LickController;
use App\Http\Controllers\SpitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/licks/stats', [LickController::class, 'stats'])->name('licks.stats');

// Add spit to existing lick
Route::get('/licks/{lick}/spits/create', [SpitController::class, 'create'])->name('spits.create');
// Store spit
Route::post('/licks/{lick}/spits', [SpitController::class, 'store'])->name('spits.store');

Route::resource('/licks', LickController::class);