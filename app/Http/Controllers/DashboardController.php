<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Figure;
use App\Models\Paint;
use App\Models\Sale;
use App\Models\Quote;
use App\Models\Bundle;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    const STOCK_CRITICO_UMBRAL = 3;

    public function index()
    {
        return view('admin.dashboard', [
            'ventasMesActual' => $this->ventasDelMes(),
            'porcentajeVentas' => $this->porcentajeCambioVentas(),
            'stockCritico' => $this->stockCritico(),
            'listaStockCritico' => $this->listaStockCritico(),
            'cotizacionesActivas' => $this->cotizacionesActivas(),
            'inventarioTotal' => $this->inventarioTotal(),
            'ventasUltimos30Dias' => json_encode($this->ventasUltimos30Dias()),
            'distribucionInventario' => json_encode($this->distribucionInventario()),
        ]);
    }

    /**
     * Retorna el total de ventas del mes actual.
     */
    private function ventasDelMes(): float
    {
        $now = Carbon::now();

        return cache()->remember('ventas_mes_actual', 300, function () use ($now) {
            return Sale::whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year)
                ->sum('total_amount');
        });
    }

    /**
     * Calcula el porcentaje de cambio entre el mes actual y el anterior.
     * Ejemplos:
     *   - Mes anterior $1000, actual $1200  → +20%
     *   - Mes anterior $0,    actual $500   → +100% (crecimiento desde cero)
     *   - Mes anterior $0,    actual $0     → 0%
     */
    private function porcentajeCambioVentas(): float
    {
        $now = Carbon::now();

        // Calcula la fecha del mes anterior una vez
        $mesAnterior = $now->copy()->subMonth();

        $ventasMesActual = $this->ventasDelMes();

        $ventasMesAnterior = cache()->remember('ventas_mes_anterior', 300, function () use ($mesAnterior) {
            return Sale::whereMonth('created_at', $mesAnterior->month)
                ->whereYear('created_at', $mesAnterior->year)
                ->sum('total_amount');
        });

        // Si el mes anterior tuvo ventas, calcula el porcentaje normal
        if ($ventasMesAnterior > 0) {
            return (($ventasMesActual - $ventasMesAnterior) / $ventasMesAnterior) * 100;
        }

        // Si no hubo ventas el mes anterior pero sí este mes, es 100% de crecimiento
        if ($ventasMesActual > 0) {
            return 100.0;
        }

        // Ambos meses en cero, sin cambio
        return 0.0;
    }

    /**
     * Cuenta productos con stock por debajo del umbral definido en la constante.
     * Se cachea 5 minutos para no consultar inventario en cada carga.
     */
    private function stockCritico(): int
    {
        return cache()->remember('stock_critico', 300, function () {
            $figuras = Figure::where('stock', '<', self::STOCK_CRITICO_UMBRAL)->count();
            $pinturas = Paint::where('stock', '<', self::STOCK_CRITICO_UMBRAL)->count();

            // Aquí puedes sumar Bundle::where(...)->count() cuando sea necesario
            return $figuras + $pinturas;
        });
    }

    /**
     * Devuelve la lista de productos con stock por debajo del umbral.
     * Se cachea 5 minutos.
     */
    private function listaStockCritico()
    {
        return cache()->remember('lista_stock_critico', 300, function () {
            $figuras = Figure::where('stock', '<', self::STOCK_CRITICO_UMBRAL)
                ->select('name', 'stock')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'stock' => $item->stock,
                        'tipo' => 'Figura'
                    ];
                });

            $pinturas = Paint::where('stock', '<', self::STOCK_CRITICO_UMBRAL)
                ->select('name', 'stock')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'stock' => $item->stock,
                        'tipo' => 'Pintura'
                    ];
                });

            return $figuras->concat($pinturas)->values()->all();
        });
    }

    //Retorna el número de cotizaciones con estado 'pending'.
    private function cotizacionesActivas(): int
    {
        return cache()->remember('cotizaciones_activas', 300, function () {
            return Quote::where('status', 'pending')->count();
        });
    }

    /**
     * Calcula el valor total del inventario sumando (stock * precio) por tabla.
     * El ?? 0 protege contra el caso en que no haya registros y value() retorne null.
     * Se cachea 5 minutos ya que el inventario no cambia en tiempo real.
     */
    private function inventarioTotal(): float
    {
        return cache()->remember('inventario_total', 300, function () {
            $figuras = Figure::select(DB::raw('SUM(stock * price) as total'))->value('total') ?? 0;
            $pinturas = Paint::select(DB::raw('SUM(stock * price) as total'))->value('total') ?? 0;

            // Cuando agregues Bundle, súmalo aquí:
            // $bundles = Bundle::select(DB::raw('SUM(stock * price) as total'))->value('total') ?? 0;
            // return $figuras + $pinturas + $bundles;

            return $figuras + $pinturas;
        });
    }

    /**
     * Obtiene las ventas agrupadas por fecha de los últimos 30 días.
     */
    private function ventasUltimos30Dias(): array
    {
        $hace30Dias = Carbon::now()->subDays(30)->startOfDay();

        $ventas = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->where('created_at', '>=', $hace30Dias)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'asc')
            ->get();

        // Rellenar días sin ventas con 0 para que la gráfica no tenga huecos
        $fechas = [];
        for ($i = 30; $i >= 0; $i--) {
            $fecha = Carbon::now()->subDays($i)->format('Y-m-d');
            $fechas[$fecha] = 0;
        }

        foreach ($ventas as $venta) {
            $fechas[$venta->date] = (float) $venta->total;
        }

        return [
            'labels' => array_keys($fechas),
            'data' => array_values($fechas),
        ];
    }

    /**
     * Obtiene la distribución de stock entre los diferentes tipos de productos.
     */
    private function distribucionInventario(): array
    {
        $figuras = Figure::sum('stock') ?? 0;
        $pinturas = Paint::sum('stock') ?? 0;
        
        // Los bundles no tienen columna 'stock', su disponibilidad depende de sus items.
        // Por ahora, lo pondremos en 0 para no romper la gráfica, o podríamos contar 
        // cuántos bundles distintos existen: Bundle::count();
        $paquetes = Bundle::count();

        return [
            'labels' => ['Figuras', 'Pinturas', 'Paquetes'],
            'data' => [$figuras, $pinturas, $paquetes],
        ];
    }
}