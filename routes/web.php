<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPerawatController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/viewDataPerawat', [DataPerawatController::class, 'index'])->name('dataPerawat.index');
        Route::post('/dataPerawat', [DataPerawatController::class, 'store'])->name('dataPerawat.store');
        Route::put('/dataPerawat/{id}', [DataPerawatController::class, 'update'])->name('dataPerawat.update');
        Route::delete('/dataPerawat/{id}', [DataPerawatController::class, 'destroy'])->name('dataPerawat.destroy');
    });
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
