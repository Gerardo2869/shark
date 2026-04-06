<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/paints/create', function () {
    return view('paints.create');
});

Route::post('/paints', [PaintController::class, 'store']);
Route::get('/paints', [PaintController::class, 'index'])->name('paints.index');
Route::get('/paints/{paint}/edit', [PaintController::class, 'edit'])->name('paints.edit');
Route::put('/paints/{paint}', [PaintController::class, 'update'])->name('paints.update');
Route::delete('/paints/{paint}', [PaintController::class, 'destroy'])->name('paints.destroy');