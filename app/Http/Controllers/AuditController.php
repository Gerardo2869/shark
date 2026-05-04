<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $movements = Movement::with('user', 'movable')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.audit.index', compact('movements'));
    }
}
