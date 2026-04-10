<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    public function index(Request $request)
    {
        $query = Figure::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('faction', 'like', "%{$search}%")
                  ->orWhere('unit_type', 'like', "%{$search}%");
            });
        }

        if ($request->filled('condition') && $request->input('condition') !== 'all') {
            $query->where('condition', $request->input('condition'));
        }
        
        if ($request->filled('faction') && $request->input('faction') !== 'all') {
            $query->where('faction', $request->input('faction'));
        }

        if ($request->filled('is_active') && $request->input('is_active') !== 'all') {
            $query->where('is_active', $request->input('is_active'));
        }

        if ($request->filled('stock_level')) {
            if ($request->input('stock_level') === 'low') {
                $query->where('stock', '<=', 2)->where('stock', '>', 0);
            } elseif ($request->input('stock_level') === 'out') {
                $query->where('stock', 0);
            } elseif ($request->input('stock_level') === 'in_stock') {
                $query->where('stock', '>', 0);
            }
        }

        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        // Columnas permitidas para ordenar
        $allowedSorts = ['id', 'name', 'faction', 'stock', 'price', 'points'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $figures = $query->paginate(12);

        return view('figures.index', compact('figures'));
    }

    public function store(Request $request)
    {
        Figure::create($request->all());
        return redirect('/figures')->with('success', 'Figura guardada exitosamente.');
    }


    public function update(Request $request, Figure $figure)
    {
        $figure->update($request->all());
        return redirect('/figures')->with('success', 'Figura actualizada exitosamente.');
    }

    public function destroy(Figure $figure)
    {
        $figure->delete();
        return redirect('/figures')->with('success', 'Figura eliminada exitosamente.');
    }
}
