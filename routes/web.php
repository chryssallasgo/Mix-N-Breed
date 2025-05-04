<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dogs/create', [DogController::class, 'create']);
Route::post('/dogs', [DogController::class, 'store']);
Route::get('/', [DashboardController::class, 'index']);
