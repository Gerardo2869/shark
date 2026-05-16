<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\Paint;
use App\Models\Bundle;
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
                    'image' => $item->image ? (filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image)) : null,
                    'hex_color' => null,
                    'is_bundle' => false,
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
                    'is_bundle' => false,
                ];
            });

        // Fetch Bundles
        $bundles = Bundle::where('is_active', true)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'bundle_' . $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'stock' => null, // Bundles don't have direct stock
                    'category' => 'Promoción',
                    'type' => 'Paquete (Kit)',
                    'image' => $item->image ? asset('storage/' . $item->image) : null,
                    'hex_color' => null,
                    'is_bundle' => true,
                    'description' => $item->description,
                ];
            });

        // Combine and sort
        $items = $figures->concat($paints)->concat($bundles)->shuffle();

        return view('catalog.index', compact('items'));
    }
}

