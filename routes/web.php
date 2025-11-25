<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LickController;
use App\Http\Controllers\SpitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Login logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Register new user
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {

    // Licks, Spits and stats
    Route::get('/', [LickController::class, 'index'])->name('home');
    Route::get('/licks/stats', [LickController::class, 'stats'])->name('licks.stats');
    Route::resource('/licks', LickController::class);
    Route::get('/spits/create/{lick}', [SpitController::class, 'create'])->name('spits.create');
    Route::post('/spits/store/{id}', [SpitController::class, 'store'])->name('spits.store');

    // User profile
    Route::get('/profile', [UserController::class, 'show'])->name('user.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/profile/edit', [UserController::class, 'update'])->name('user.update');
});
