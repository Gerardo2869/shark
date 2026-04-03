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
Route::get('/paints', [PaintController::class, 'index']);