<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Figure;
use App\Models\Paint;

class PurchaseOrderController extends Controller
{
    public function preview()
    {
        $umbral = DashboardController::STOCK_CRITICO_UMBRAL;

        $figuras = Figure::with('supplier')->where('stock', '<', $umbral)->get();
        $pinturas = Paint::with('supplier')->where('stock', '<', $umbral)->get();

        $criticalProducts = collect();

        foreach ($figuras as $figura) {
            $criticalProducts->push([
                'name' => $figura->name,
                'stock' => $figura->stock,
                'type' => 'Figura',
                'supplier_name' => $figura->supplier ? $figura->supplier->name : 'Sin Proveedor',
            ]);
        }

        foreach ($pinturas as $pintura) {
            $criticalProducts->push([
                'name' => $pintura->name,
                'stock' => $pintura->stock,
                'type' => 'Pintura',
                'supplier_name' => $pintura->supplier ? $pintura->supplier->name : 'Sin Proveedor',
            ]);
        }

        $groupedBySupplier = $criticalProducts->groupBy('supplier_name');

        return view('purchase_orders.preview', compact('groupedBySupplier'));
    }
}
