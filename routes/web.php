<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\FigureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect('/paints');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Read access: auth users
    Route::get('/paints', [PaintController::class, 'index'])->name('paints.index');
    Route::get('/figures', [FigureController::class, 'index'])->name('figures.index');

    // Sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    // Profile access
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Write access: admin only
    Route::middleware('is_admin')->group(function () {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
        Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

        Route::post('/paints', [PaintController::class, 'store']);
        Route::put('/paints/{paint}', [PaintController::class, 'update'])->name('paints.update');
        Route::delete('/paints/{paint}', [PaintController::class, 'destroy'])->name('paints.destroy');

        Route::post('/figures', [FigureController::class, 'store']);
        Route::put('/figures/{figure}', [FigureController::class, 'update'])->name('figures.update');
        Route::delete('/figures/{figure}', [FigureController::class, 'destroy'])->name('figures.destroy');
    });
});