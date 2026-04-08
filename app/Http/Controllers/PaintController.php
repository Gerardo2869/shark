<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Illuminate\Http\Request;

class PaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Paint::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        // Columnas permitidas para ordenar
        $allowedSorts = ['id', 'name', 'brand', 'stock', 'price', 'expiration_date'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $paints = $query->paginate(12);

        return view('paints.index', compact('paints'));
    }

    public function store(Request $request)
    {
        Paint::create($request->all());
        return redirect('/paints')->with('success', 'Pintura guardada exitosamente.');
    }


    public function update(Request $request, Paint $paint)
    {
        $paint->update($request->all());
        return redirect('/paints')->with('success', 'Pintura actualizada exitosamente.');
    }

    public function destroy(Paint $paint)
    {
        $paint->delete();
        return redirect('/paints')->with('success', 'Pintura eliminada exitosamente.');
    }
}