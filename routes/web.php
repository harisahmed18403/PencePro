<?php

use App\Http\Controllers\LickController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/licks', LickController::class);