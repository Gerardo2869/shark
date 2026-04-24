<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Paint;
use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the sales history.
     */
    public function index()
    {
        $sales = Sale::with('user', 'items.sellable')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new sale.
     */
    public function create()
    {
        $paints = Paint::where('is_active', true)->where('stock', '>', 0)->get();
        $figures = Figure::where('is_active', true)->where('stock', '>', 0)->get();

        return view('sales.create', compact('paints', 'figures'));
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.type' => 'required|string|in:paint,figure',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $totalAmount = 0;
                $itemsToCreate = [];

                foreach ($request->items as $itemData) {
                    $modelClass = $itemData['type'] === 'paint' ? Paint::class : Figure::class;
                    $item = $modelClass::lockForUpdate()->findOrFail($itemData['id']);

                    // Validate stock
                    if ($item->stock < $itemData['quantity']) {
                        throw new \Exception("Stock insuficiente para: {$item->name}. Disponible: {$item->stock}");
                    }

                    $subtotal = $item->price * $itemData['quantity'];
                    $totalAmount += $subtotal;

                    $itemsToCreate[] = [
                        'sellable_type' => $modelClass,
                        'sellable_id' => $item->id,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $item->price,
                        'subtotal' => $subtotal,
                    ];

                    // Decrease stock
                    $item->decrement('stock', $itemData['quantity']);
                }

                // Create the sale header
                $sale = Sale::create([
                    'user_id' => Auth::id(),
                    'total_amount' => $totalAmount,
                ]);

                // Create the sale items
                foreach ($itemsToCreate as $saleItemData) {
                    $saleItemData['sale_id'] = $sale->id;
                    SaleItem::create($saleItemData);
                }

                return redirect('/sales')->with('success', 'Venta registrada exitosamente. Total: $' . number_format($totalAmount, 2));
            });

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
