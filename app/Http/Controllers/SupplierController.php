<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function updateEmail(Request $request, Supplier $supplier)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $supplier->update([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', "Correo actualizado para {$supplier->name}");
    }
}
