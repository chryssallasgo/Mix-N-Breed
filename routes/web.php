<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogMatchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('dashboard');
});
//Dog Profile CRUD Routes
Route::get('/dogprofiles', [DogProfileController::class, 'index'])->name('dogprofiles.index');
Route::get('/dogprofiles/create', [DogProfileController::class, 'create'])->name('dogprofiles.create');
Route::post('/dogprofiles', [DogProfileController::class, 'store'])->name('dogprofiles.store');
//Dog Match Routes
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dogmatch', [DogMatchController::class, 'showForm'])->name('dogmatch.form');
Route::post('/dogmatch', [DogMatchController::class, 'mix'])->name('dogmatch.mix');

//Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
