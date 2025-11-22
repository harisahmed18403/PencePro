<?php

use App\Http\Controllers\LickController;
use App\Http\Controllers\SpitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LickController::class, 'index'])->name('home');

Route::get('/licks/stats', [LickController::class, 'stats'])->name('licks.stats');

Route::resource('/licks', LickController::class);
Route::get('/spits/create/{lick}', [SpitController::class, 'create'])->name('spits.create');
Route::post('/spits/store/{id}', [SpitController::class, 'store'])->name('spits.store');