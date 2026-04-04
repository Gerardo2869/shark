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
        return redirect('/paints')->with('success', 'Pintura guardada exitosamente.');
    }

    public function edit(Paint $paint)
    {
        return view('paints.edit', compact('paint'));
    }

    public function update(Request $request, Paint $paint)
    {
        $paint->update($request->all());
        return redirect('/paints')->with('success', 'Pintura actualizada exitosamente.');
    }
}