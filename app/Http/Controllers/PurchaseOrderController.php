<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Figure;
use App\Models\Paint;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Auth;

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
        $suppliers = \App\Models\Supplier::all()->keyBy('name');

        return view('purchase_orders.preview', compact('groupedBySupplier', 'suppliers'));
    }

    public function downloadPdf($supplierName)
    {
        $umbral = DashboardController::STOCK_CRITICO_UMBRAL;

        $figuras = Figure::with('supplier')->where('stock', '<', $umbral)->get();
        $pinturas = Paint::with('supplier')->where('stock', '<', $umbral)->get();

        $criticalProducts = collect();

        foreach ($figuras as $figura) {
            $supplier = $figura->supplier ? $figura->supplier->name : 'Sin Proveedor';
            if ($supplier === $supplierName) {
                $criticalProducts->push([
                    'name' => $figura->name,
                    'stock' => $figura->stock,
                    'type' => 'Figura',
                ]);
            }
        }

        foreach ($pinturas as $pintura) {
            $supplier = $pintura->supplier ? $pintura->supplier->name : 'Sin Proveedor';
            if ($supplier === $supplierName) {
                $criticalProducts->push([
                    'name' => $pintura->name,
                    'stock' => $pintura->stock,
                    'type' => 'Pintura',
                ]);
            }
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('purchase_orders.pdf', [
            'supplierName' => $supplierName,
            'items' => $criticalProducts
        ]);

        $supplierModel = \App\Models\Supplier::where('name', $supplierName)->first();
        if ($supplierModel) {
            PurchaseOrder::create([
                'supplier_id' => $supplierModel->id,
                'user_id' => Auth::id(),
                'status' => 'pendiente',
                'details' => $criticalProducts->toArray(),
            ]);
        }

        return $pdf->download("orden_compra_{$supplierName}.pdf");
    }

    public function sendEmail($supplierName)
    {
        $umbral = DashboardController::STOCK_CRITICO_UMBRAL;

        $figuras = Figure::with('supplier')->where('stock', '<', $umbral)->get();
        $pinturas = Paint::with('supplier')->where('stock', '<', $umbral)->get();

        $criticalProducts = collect();

        foreach ($figuras as $figura) {
            $supplier = $figura->supplier ? $figura->supplier->name : 'Sin Proveedor';
            if ($supplier === $supplierName) {
                $criticalProducts->push([
                    'name' => $figura->name,
                    'stock' => $figura->stock,
                    'type' => 'Figura',
                ]);
            }
        }

        foreach ($pinturas as $pintura) {
            $supplier = $pintura->supplier ? $pintura->supplier->name : 'Sin Proveedor';
            if ($supplier === $supplierName) {
                $criticalProducts->push([
                    'name' => $pintura->name,
                    'stock' => $pintura->stock,
                    'type' => 'Pintura',
                ]);
            }
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('purchase_orders.pdf', [
            'supplierName' => $supplierName,
            'items' => $criticalProducts
        ]);

        $supplier = \App\Models\Supplier::where('name', $supplierName)->first();

        if ($supplier && $supplier->email) {
            \Illuminate\Support\Facades\Mail::to($supplier->email)->send(new \App\Mail\PurchaseOrderMail($pdf->output(), $supplierName));
            
            PurchaseOrder::create([
                'supplier_id' => $supplier->id,
                'user_id' => Auth::id(),
                'status' => 'pendiente',
                'details' => $criticalProducts->toArray(),
            ]);

            return redirect()->back()->with('success', "Correo enviado a {$supplierName} con éxito.");
        }

        return redirect()->back()->with('error', "El proveedor {$supplierName} no tiene correo registrado.");
    }

    public function history()
    {
        $orders = PurchaseOrder::with(['supplier', 'user'])->orderBy('created_at', 'desc')->get();
        return view('purchase_orders.history', compact('orders'));
    }

    public function markAsReceived(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update(['status' => 'recibida']);
        return redirect()->back()->with('success', 'Orden marcada como recibida.');
    }
}
