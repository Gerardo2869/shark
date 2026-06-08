<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\FigureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;

use App\Http\Controllers\PublicCatalogController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/catalogo');
});

Route::get('/catalogo', [PublicCatalogController::class, 'index'])->name('catalog.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Read access: auth users
    Route::get('/paints', [PaintController::class, 'index'])->name('paints.index');
    Route::get('/figures', [FigureController::class, 'index'])->name('figures.index');
    Route::get('/figures/pdf', [FigureController::class, 'downloadPdf'])->name('figures.pdf');

    // Sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    // Quotes
    Route::resource('quotes', \App\Http\Controllers\QuoteController::class);
    Route::post('/quotes/{quote}/convert', [\App\Http\Controllers\QuoteController::class, 'convertToSale'])->name('quotes.convert');

    // Profile access
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/purchase-orders/preview', [\App\Http\Controllers\PurchaseOrderController::class, 'preview'])->name('purchase-orders.preview');
    Route::get('/purchase-orders/download/{supplier}', [\App\Http\Controllers\PurchaseOrderController::class, 'downloadPdf'])->name('purchase-orders.download');
    Route::get('/purchase-orders/send-email/{supplier}', [\App\Http\Controllers\PurchaseOrderController::class, 'sendEmail'])->name('purchase-orders.send-email');
    Route::get('/purchase-orders/history', [\App\Http\Controllers\PurchaseOrderController::class, 'history'])->name('purchase_orders.history');
    Route::patch('/purchase-orders/{purchaseOrder}/received', [\App\Http\Controllers\PurchaseOrderController::class, 'markAsReceived'])->name('purchase_orders.received');
    Route::put('/suppliers/{supplier}/email', [\App\Http\Controllers\SupplierController::class, 'updateEmail'])->name('suppliers.updateEmail');

    // Write access: admin only
    Route::middleware('is_admin')->group(function () {
        
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);
        Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        
        // Audit Logs
        Route::get('/audit', [\App\Http\Controllers\AuditController::class, 'index'])->name('audit.index');

        // Bundles
        Route::resource('bundles', BundleController::class);

        Route::post('/paints', [PaintController::class, 'store']);
        Route::put('/paints/{paint}', [PaintController::class, 'update'])->name('paints.update');
        Route::delete('/paints/{paint}', [PaintController::class, 'destroy'])->name('paints.destroy');

        Route::post('/figures', [FigureController::class, 'store']);
        Route::put('/figures/{figure}', [FigureController::class, 'update'])->name('figures.update');
        Route::delete('/figures/{figure}', [FigureController::class, 'destroy'])->name('figures.destroy');
    });
});