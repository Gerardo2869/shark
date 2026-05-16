<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Figure;
use App\Models\Paint;
use App\Models\Bundle;
use App\Models\Sale;
use App\Models\Quote;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // For Phase 1, we just return the view. 
        // We'll add stats in Phase 3.
        return view('admin.dashboard');
    }
}
