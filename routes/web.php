<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/paints', [PaintController::class, 'store']);
Route::get('/paints', [PaintController::class, 'index'])->name('paints.index');
Route::put('/paints/{paint}', [PaintController::class, 'update'])->name('paints.update');
Route::delete('/paints/{paint}', [PaintController::class, 'destroy'])->name('paints.destroy');