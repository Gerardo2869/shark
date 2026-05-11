<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\BundleItem;
use App\Models\Figure;
use App\Models\Paint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BundleController extends Controller
{
    public function index()
    {
        $bundles = Bundle::with('items.sellable')->orderBy('created_at', 'desc')->paginate(10);
        return view('bundles.index', compact('bundles'));
    }

    public function create()
    {
        $figures = Figure::where('is_active', true)->orderBy('name')->get();
        $paints = Paint::where('is_active', true)->orderBy('name')->get();
        return view('bundles.create', compact('figures', 'paints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.type' => 'required|string|in:figure,paint',
            'items.*.quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $data = $request->only(['name', 'description', 'price']);
                
                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image')->store('bundles', 'public');
                }

                $bundle = Bundle::create($data);

                foreach ($request->items as $itemData) {
                    $bundle->items()->create([
                        'sellable_type' => $itemData['type'] === 'figure' ? Figure::class : Paint::class,
                        'sellable_id' => $itemData['id'],
                        'quantity' => $itemData['quantity'],
                    ]);
                }

                return redirect()->route('bundles.index')->with('success', 'Paquete creado exitosamente.');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear el paquete: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Bundle $bundle)
    {
        if ($bundle->image) {
            Storage::disk('public')->delete($bundle->image);
        }
        $bundle->delete();
        return redirect()->route('bundles.index')->with('success', 'Paquete eliminado exitosamente.');
    }
}
