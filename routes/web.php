<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/viewDataPerawat', [AdminController::class, 'view'])->name('admin.dataPerawat');
        Route::get('/dataPerawat', [AdminController::class, 'index'])->name('dataPerawat.index');
        Route::post('/dataPerawat', [AdminController::class, 'store'])->name('dataPerawat.store');
        Route::post('/dataPerawat/{id}', [AdminController::class, 'edit'])->name('dataPerawat.edit');
        Route::delete('/dataPerawat/{id}', [AdminController::class, 'destroy'])->name('dataPerawat.destroy');
    });
});

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
