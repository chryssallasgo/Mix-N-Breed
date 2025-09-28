<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DogProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogMatchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DogProfileController as AdminDogProfileController;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('dogprofiles', DogProfileController::class);
    Route::get('/dogmatch', [DogMatchController::class, 'form'])->name('dogmatch.form');
});
//Dog Profile CRUD Routes
Route::middleware('auth')->group(function () {
    Route::get('/dogprofiles', [DogProfileController::class, 'index'])->name('dogprofiles.index');
    Route::get('/dogprofiles/create', [DogProfileController::class, 'create'])->name('dogprofiles.create');
    Route::post('/dogprofiles', [DogProfileController::class, 'store'])->name('dogprofiles.store');
    Route::get('/dogprofiles/{id}/edit', [DogProfileController::class, 'edit'])->name('dogprofiles.edit');
    Route::put('/dogprofiles/{id}', [DogProfileController::class, 'update'])->name('dogprofiles.update');
    Route::delete('/dogprofiles/{id}', [DogProfileController::class, 'destroy'])->name('dogprofiles.destroy');
});
//Dog Match Routes
Route::get('/', [DashboardController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::get('/dogmatch', [DogMatchController::class, 'form'])->name('dogmatch.form');
    Route::post('/dogmatch/process', [DogMatchController::class, 'process'])->name('dogmatch.process');
});
//Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::view('/get-started', 'get-started')->name('get-started');
Route::view('/docs', 'docs')->name('docs');
Route::view('/about', 'about')->name('about');

//admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admindashboard', [AdminUserController::class, 'admindashboard'])->name('admindashboard');

    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);
    Route::resource('dogprofiles', AdminDogProfileController::class)->except(['create', 'store', 'show']);
});
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
