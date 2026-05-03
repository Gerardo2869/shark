<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Paint;
use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuoteController extends Controller
{
    /**
     * Display a listing of the quotes.
     */
    public function index()
    {
        $quotes = Quote::with('user', 'items.quotable')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new quote.
     */
    public function create()
    {
        // For quotes, we might want to show all active items even if stock is 0 (as it's a quote for future stock perhaps)
        // But for consistency with sales, let's stick to active items.
        $paints = Paint::where('is_active', true)->get();
        $figures = Figure::where('is_active', true)->get();

        return view('quotes.create', compact('paints', 'figures'));
    }

    /**
     * Store a newly created quote in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'nullable|string|max:255',
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
                    $item = $modelClass::findOrFail($itemData['id']);

                    $subtotal = $item->price * $itemData['quantity'];
                    $totalAmount += $subtotal;

                    $itemsToCreate[] = [
                        'quotable_type' => $modelClass,
                        'quotable_id' => $item->id,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $item->price,
                        'subtotal' => $subtotal,
                    ];
                }

                // Create the quote header
                $quote = Quote::create([
                    'user_id' => Auth::id(),
                    'client_name' => $request->client_name,
                    'total_amount' => $totalAmount,
                    'expires_at' => Carbon::now()->addDays(30)->endOfDay(), // Exactly 30 days, valid until end of day
                    'status' => 'pending',
                ]);

                // Create the quote items
                foreach ($itemsToCreate as $quoteItemData) {
                    $quoteItemData['quote_id'] = $quote->id;
                    QuoteItem::create($quoteItemData);
                }

                return redirect('/quotes')->with('success', 'Cotización creada exitosamente. Válida hasta: ' . $quote->expires_at->format('d/m/Y'));
            });

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al crear la cotización: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified quote.
     */
    public function show(Quote $quote)
    {
        $quote->load('user', 'items.quotable');
        return view('quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified quote.
     */
    public function edit(Quote $quote)
    {
        $quote->load('items.quotable');
        $paints = Paint::where('is_active', true)->get();
        $figures = Figure::where('is_active', true)->get();

        return view('quotes.edit', compact('quote', 'paints', 'figures'));
    }

    /**
     * Update the specified quote in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'client_name' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer',
            'items.*.type' => 'required|string|in:paint,figure',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            return DB::transaction(function () use ($request, $quote) {
                $totalAmount = 0;
                $itemsToCreate = [];

                foreach ($request->items as $itemData) {
                    $modelClass = $itemData['type'] === 'paint' ? Paint::class : Figure::class;
                    $item = $modelClass::findOrFail($itemData['id']);

                    $subtotal = $item->price * $itemData['quantity'];
                    $totalAmount += $subtotal;

                    $itemsToCreate[] = [
                        'quotable_type' => $modelClass,
                        'quotable_id' => $item->id,
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $item->price,
                        'subtotal' => $subtotal,
                    ];
                }

                // Update the quote header
                $quote->update([
                    'client_name' => $request->client_name,
                    'total_amount' => $totalAmount,
                ]);

                // Remove old items and add new ones
                $quote->items()->delete();

                foreach ($itemsToCreate as $quoteItemData) {
                    $quoteItemData['quote_id'] = $quote->id;
                    QuoteItem::create($quoteItemData);
                }

                return redirect('/quotes')->with('success', 'Cotización actualizada correctamente.');
            });

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar la cotización: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Convert a quote into a finalized sale.
     */
    public function convertToSale(Quote $quote)
    {
        // Check if already converted
        if ($quote->status === 'converted') {
            return back()->withErrors(['error' => 'Esta cotización ya fue convertida en venta.']);
        }

        // Check if expired
        if ($quote->isExpired()) {
            return back()->withErrors(['error' => 'No se puede convertir una cotización expirada.']);
        }

        try {
            return DB::transaction(function () use ($quote) {
                // 1. Create the Sale
                $sale = Sale::create([
                    'user_id' => Auth::id(),
                    'total_amount' => $quote->total_amount,
                ]);

                // 2. Process items
                foreach ($quote->items as $quoteItem) {
                    $item = $quoteItem->quotable; // Figure or Paint

                    // Re-check stock since time has passed since the quote
                    if ($item->stock < $quoteItem->quantity) {
                        throw new \Exception("Stock insuficiente para: {$item->name}. Disponible: {$item->stock}");
                    }

                    // Decrement stock
                    $item->decrement('stock', $quoteItem->quantity);

                    // Create SaleItem
                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'sellable_type' => $quoteItem->quotable_type,
                        'sellable_id' => $quoteItem->quotable_id,
                        'quantity' => $quoteItem->quantity,
                        'unit_price' => $quoteItem->unit_price,
                        'subtotal' => $quoteItem->subtotal,
                    ]);
                }

                // 3. Mark Quote as converted
                $quote->update(['status' => 'converted']);

                return redirect('/sales')->with('success', 'Cotización convertida en venta exitosamente. Venta #' . $sale->id);
            });

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al convertir venta: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified quote from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect('/quotes')->with('success', 'Cotización eliminada correctamente.');
    }
}
