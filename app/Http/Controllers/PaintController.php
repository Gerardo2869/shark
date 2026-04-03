<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Illuminate\Http\Request;

class PaintController extends Controller
{
    public function index()
    {
        $paints = Paint::all();
        return view('paints.index', compact('paints'));
    }

    public function store(Request $request)
    {
        Paint::create($request->all());
        return "Guardado correctamente";
    }
}