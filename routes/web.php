<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\FigureController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/paints', [PaintController::class, 'store']);
Route::get('/paints', [PaintController::class, 'index'])->name('paints.index');
Route::put('/paints/{paint}', [PaintController::class, 'update'])->name('paints.update');
Route::delete('/paints/{paint}', [PaintController::class, 'destroy'])->name('paints.destroy');

Route::post('/figures', [FigureController::class, 'store']);
Route::get('/figures', [FigureController::class, 'index'])->name('figures.index');
Route::put('/figures/{figure}', [FigureController::class, 'update'])->name('figures.update');
Route::delete('/figures/{figure}', [FigureController::class, 'destroy'])->name('figures.destroy');