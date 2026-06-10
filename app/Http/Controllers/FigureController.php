<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\Supplier;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    public function index(Request $request)
    {
        $query = Figure::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
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

        $figures = $query->paginate(15);

        $outOfStockCount = Figure::where('stock', 0)->where('is_active', 1)->count();
        $lowStockCount = Figure::where('stock', '>', 0)->where('stock', '<=', 2)->where('is_active', 1)->count();

        $suppliers = Supplier::all();

        return view('figures.index', compact('figures', 'outOfStockCount', 'lowStockCount', 'suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('figures', 'public');
            $data['image'] = $path;
        }

        Figure::create($data);
        return redirect('/figures')->with('success', 'Figura guardada exitosamente.');
    }


    public function update(Request $request, Figure $figure)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($figure->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($figure->image);
            }
            $path = $request->file('image')->store('figures', 'public');
            $data['image'] = $path;
        }

        $figure->update($data);
        return redirect('/figures')->with('success', 'Figura actualizada exitosamente.');
    }

    public function destroy(Figure $figure)
    {
        if ($figure->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($figure->image);
        }
        $figure->delete();
        return redirect('/figures')->with('success', 'Figura eliminada exitosamente.');
    }

    public function downloadPdf(Request $request)
    {
        $query = Figure::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
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

        $allowedSorts = ['id', 'name', 'faction', 'stock', 'price', 'points'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $figures = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('figures.pdf', [
            'figures' => $figures
        ]);

        return $pdf->download("catalogo_figuras.pdf");
    }

    public function downloadCsv(Request $request)
    {
        $query = Figure::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
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

        $allowedSorts = ['id', 'name', 'faction', 'stock', 'price', 'points'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $figures = $query->get();

        $filename = "catalogo_figuras.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nombre', 'Facción', 'Tipo de Unidad', 'Condición', 'Stock', 'Precio', 'Puntos', 'Activo'];

        $callback = function() use($figures, $columns) {
            $file = fopen('php://output', 'w');
            
            // Output BOM for UTF-8 to ensure Excel displays special characters correctly
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);

            foreach ($figures as $figure) {
                fputcsv($file, [
                    $figure->id,
                    $figure->name,
                    $figure->faction,
                    $figure->unit_type,
                    $figure->condition,
                    $figure->stock,
                    $figure->price,
                    $figure->points,
                    $figure->is_active ? 'Sí' : 'No'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
