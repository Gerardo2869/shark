<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\Paint;
use Illuminate\Http\Request;

class PublicCatalogController extends Controller
{
    /**
     * Display the public catalog for guests.
     */
    public function index(Request $request)
    {
        // Fetch Figures
        $figures = Figure::where('is_active', true)
            ->where('stock', '>', 0)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'fig_' . $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'stock' => $item->stock,
                    'category' => $item->faction ?: 'General',
                    'type' => 'Figura',
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'hex_color' => null,
                ];
            });

        // Fetch Paints
        $paints = Paint::where('is_active', true)
            ->where('stock', '>', 0)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'paint_' . $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'stock' => $item->stock,
                    'category' => $item->brand ?: 'Genérica',
                    'type' => 'Pintura',
                    'image' => null,
                    'hex_color' => $item->hex_color,
                ];
            });

        // Combine and sort by latest (using standard created_at would be better if we had it, but for now we just merge)
        $items = $figures->concat($paints)->shuffle(); // Shuffling for a dynamic look, or sort by name

        return view('catalog.index', compact('items'));
    }
}

