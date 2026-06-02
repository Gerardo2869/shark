<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Shark Inventory</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --primary-color: #0071e3;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-color: #000000;
            --text-color: #f5f5f7;
            --text-muted: #a1a1a6;
            --card-bg: #1c1c1e;
            --border-color: #38383a;
            --input-bg: #2c2c2e;
            --primary-color: #0a84ff;
            --primary-hover: #409cff;
        }

        .theme-toggle-admin {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .theme-toggle-admin:hover {
            background-color: rgba(128, 128, 128, 0.1);
        }


        body {
            transition: background-color 0.5s ease, color 0.5s ease;
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            padding: 60px 20px;
            box-sizing: border-box;
        }

        header {
            text-align: left;
            margin-bottom: 50px;
            width: 100%;
        }

        header h1 {
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin: 0;
        }

        header p {
            font-size: 20px;
            color: var(--text-muted);
            margin: 8px 0 0 0;
            font-weight: 500;
        }

        .launchpad-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            width: 100%;
        }

        /* --- KPI WIDGETS --- */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            width: 100%;
            margin-bottom: 40px;
        }

        .kpi-card {
            background-color: var(--card-bg);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.03);
            transition: var(--transition);
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.08);
        }

        .kpi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 15px;
            font-weight: 600;
        }

        .kpi-icon {
            color: var(--primary-color);
            opacity: 0.8;
            background-color: rgba(0, 113, 227, 0.1);
            padding: 8px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kpi-icon.danger {
            color: #ff3b30;
            background-color: rgba(255, 59, 48, 0.1);
        }

        .kpi-icon.warning {
            color: #ff9500;
            background-color: rgba(255, 149, 0, 0.1);
        }

        .kpi-icon.success {
            color: #34c759;
            background-color: rgba(52, 199, 89, 0.1);
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            letter-spacing: -0.02em;
            margin: 4px 0;
        }

        .kpi-trend {
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 10px;
            width: fit-content;
        }

        .kpi-trend.positive {
            background-color: rgba(52, 199, 89, 0.1);
            color: #248a3d;
        }

        .kpi-trend.neutral {
            background-color: rgba(142, 142, 147, 0.1);
            color: #8e8e93;
        }

        .kpi-trend.negative {
            background-color: rgba(255, 59, 48, 0.1);
            color: #c93429;
        }

        .kpi-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: auto;
        }

        .module-card {
            background-color: var(--card-bg);
            border-radius: 28px;
            padding: 32px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }

        .module-card:hover {
            transform: scale(1.03) translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-color);
        }

        .module-icon {
            width: 56px;
            height: 56px;
            background-color: var(--bg-color);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            transition: var(--transition);
        }

        .module-card:hover .module-icon {
            background-color: var(--primary-color);
            color: white;
            transform: rotate(-5deg);
        }

        .module-info h2 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            letter-spacing: -0.01em;
        }

        .module-info p {
            font-size: 14px;
            color: var(--text-muted);
            margin: 4px 0 0 0;
        }

        .arrow-icon {
            position: absolute;
            bottom: 32px;
            right: 32px;
            opacity: 0;
            transform: translateX(-10px);
            transition: var(--transition);
            color: var(--primary-color);
        }

        .module-card:hover .arrow-icon {
            opacity: 1;
            transform: translateX(0);
        }

        .secondary-section {
            margin-top: 60px;
            width: 100%;
        }

        .secondary-section h3 {
            font-size: 17px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 24px;
        }

        .small-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .small-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 20px;
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .small-card:hover {
            background-color: #fcfcfc;
            transform: translateY(-2px);
            border-color: var(--border-color);
        }

        .logout-btn {
            margin-top: 60px;
            padding: 12px 30px;
            background-color: #f2f2f7;
            color: #ff3b30;
            border-radius: 12px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #ff3b30;
            color: white;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            width: 100%;
            margin-bottom: 40px;
        }

        @media (max-width: 900px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background-color: var(--card-bg);
            border-radius: 24px;
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.03);
        }

        .chart-header {
            margin-bottom: 20px;
        }

        .chart-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
        }

        .chart-header p {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .launchpad-grid {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 32px;
            }
        }

        /* --- MODAL STOCK CRITICO --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 24px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color, rgba(0, 0, 0, 0.05));
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color, rgba(0, 0, 0, 0.05));
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
        }

        .modal-close-btn {
            background: rgba(128, 128, 128, 0.1);
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .modal-close-btn:hover {
            background-color: rgba(128, 128, 128, 0.2);
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
        }

        .critical-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .critical-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background-color: var(--bg-color);
            border-radius: 12px;
            border: 1px solid var(--border-color, rgba(0, 0, 0, 0.05));
        }

        .critical-item-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .critical-item-name {
            font-weight: 600;
            color: var(--text-color);
            font-size: 15px;
        }

        .critical-item-type {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .critical-item-stock {
            background-color: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header style="display:flex; justify-content:space-between; align-items:center;">
            <h1>Command Center</h1>
            <p>Gestiona tu inventario y ventas con precisión.</p>

            <button type="button" class="theme-toggle-admin" onclick="window.toggleTheme()" aria-label="Cambiar tema">
                <svg id="sunIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
                <svg id="moonIcon" style="display:none;" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>

        </header>

        <!-- WIDGETS KPI -->
        <div class="kpi-grid">
            <!-- Ventas del Mes -->
            <div class="kpi-card">
                <div class="kpi-header">
                    <span>Ventas del Mes</span>
                    <div class="kpi-icon success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
                <div class="kpi-value">${{ number_format($ventasMesActual, 2) }} <span
                        style="font-size: 16px; color: var(--text-muted);">MXN</span></div>
                @if($porcentajeVentas > 0)
                    <div class="kpi-trend positive">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                            <polyline points="16 7 22 7 22 13"></polyline>
                        </svg>
                        +{{ number_format($porcentajeVentas, 1) }}% vs mes anterior
                    </div>
                @elseif($porcentajeVentas < 0)
                    <div class="kpi-trend negative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline>
                            <polyline points="16 17 22 17 22 11"></polyline>
                        </svg>
                        {{ number_format($porcentajeVentas, 1) }}% vs mes anterior
                    </div>
                @else
                    <div class="kpi-trend neutral">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Sin cambios
                    </div>
                @endif
            </div>

            <!-- Stock Crítico -->
            <div class="kpi-card" id="stockCriticoCard" style="cursor: pointer;" title="Haz clic para ver detalles">
                <div class="kpi-header">
                    <span>Stock Crítico</span>
                    <div class="kpi-icon danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                </div>
                <div class="kpi-value" style="{{ $stockCritico > 0 ? 'color: #ff3b30;' : '' }}">{{ $stockCritico }}
                </div>
                @if($stockCritico > 0)
                    <div class="kpi-subtitle">Productos por debajo del umbral para reabastecer.</div>
                @else
                    <div class="kpi-subtitle">Inventario en óptimas condiciones.</div>
                @endif
            </div>

            <!-- Cotizaciones Activas -->
            <div class="kpi-card">
                <div class="kpi-header">
                    <span>Cotizaciones Activas</span>
                    <div class="kpi-icon warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $cotizacionesActivas }}</div>
                <div class="kpi-subtitle">Presupuestos pendientes de cierre o seguimiento.</div>
            </div>

            <!-- Inventario Total -->
            <div class="kpi-card">
                <div class="kpi-header">
                    <span>Inventario Total</span>
                    <div class="kpi-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="2" x2="12" y2="22"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
                <div class="kpi-value">${{ number_format($inventarioTotal, 2) }} <span
                        style="font-size: 16px; color: var(--text-muted);">MXN</span></div>
                <div class="kpi-subtitle">Valor total en dinero de todo tu stock actual.</div>
            </div>
        </div>

        <!-- GRÁFICOS VISUALES -->
        <div class="charts-grid">
            <!-- Gráfico de Tendencia de Ventas -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Tendencia de Ventas</h3>
                    <p>Ingresos de los últimos 30 días</p>
                </div>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Gráfico de Distribución de Inventario -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3>Distribución de Inventario</h3>
                    <p>Proporción de artículos en stock</p>
                </div>
                <div class="chart-container">
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>
        </div>

        <div class="launchpad-grid">
            <!-- Figuras -->
            <a href="{{ route('figures.index') }}" class="module-card">
                <div class="module-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z">
                        </path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="module-info">
                    <h2>Figuras</h2>
                    <p>Modelos, facciones y stock.</p>
                </div>
                <div class="arrow-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </a>

            <!-- Pinturas -->
            <a href="{{ route('paints.index') }}" class="module-card">
                <div class="module-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="m12 3 1.912 5.886H20.1l-4.996 3.633L16.99 18.4 12 14.767 7.01 18.4l1.884-5.881L3.9 8.886h6.188L12 3z" />
                    </svg>
                </div>
                <div class="module-info">
                    <h2>Pinturas</h2>
                    <p>Colores, marcas y botes.</p>
                </div>
                <div class="arrow-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </a>

            @if(auth()->check() && auth()->user()->isAdmin())
                <!-- Paquetes -->
                <a href="{{ route('bundles.index') }}" class="module-card">
                    <div class="module-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16.5A2.5 2.5 0 0 1 18.5 19H5a2.5 2.5 0 0 1-2.5-2.5V5A2.5 2.5 0 0 1 5 2.5h13.5A2.5 2.5 0 0 1 21 5v11.5z" />
                            <path d="M12 2v17" />
                            <path d="M3 12h18" />
                        </svg>
                    </div>
                    <div class="module-info">
                        <h2>Paquetes</h2>
                        <p>Kits y ofertas de ahorro.</p>
                    </div>
                    <div class="arrow-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </a>
            @endif

            <!-- Ventas -->
            <a href="{{ route('sales.index') }}" class="module-card">
                <div class="module-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <div class="module-info">
                    <h2>Ventas</h2>
                    <p>Ingresos e historial.</p>
                </div>
                <div class="arrow-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </a>

            <!-- Cotizaciones -->
            <a href="{{ route('quotes.index') }}" class="module-card">
                <div class="module-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="module-info">
                    <h2>Cotizaciones</h2>
                    <p>Presupuestos para clientes.</p>
                </div>
                <div class="arrow-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </a>
        </div>

        <div class="secondary-section">
            <h3>{{ auth()->check() && auth()->user()->isAdmin() ? 'Administración' : 'Enlaces' }}</h3>
            <div class="small-grid">
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('audit.index') }}" class="small-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>Auditoría</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="small-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Usuarios</span>
                    </a>
                @endif
                <a href="{{ route('catalog.index') }}" target="_blank" class="small-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Ver Catálogo</span>
                </a>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="width: 100%; display: flex; justify-content: center;">
            @csrf
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Datos pasados desde el DashboardController
            const salesData = {!! $ventasUltimos30Dias !!};
            const inventoryData = {!! $distribucionInventario !!};

            // Gráfico de Tendencia de Ventas (Curva Suave)
            const ctxSales = document.getElementById('salesChart').getContext('2d');

            // Gradiente para rellenar bajo la curva
            const salesGradient = ctxSales.createLinearGradient(0, 0, 0, 300);
            salesGradient.addColorStop(0, 'rgba(0, 113, 227, 0.2)');
            salesGradient.addColorStop(1, 'rgba(0, 113, 227, 0)');

            new Chart(ctxSales, {
                type: 'line',
                data: {
                    labels: salesData.labels,
                    datasets: [{
                        label: 'Ingresos',
                        data: salesData.data,
                        borderColor: '#0071e3', // Azul primario
                        backgroundColor: salesGradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0071e3',
                        pointBorderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Curva suave
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }, // Ocultamos leyenda por estética
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            titleFont: { size: 13, family: "sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "sans-serif" },
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return '$' + context.parsed.y.toLocaleString('en-US', { minimumFractionDigits: 2 }) + ' MXN';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { maxTicksLimit: 7, color: '#86868b' }
                        },
                        y: {
                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                            ticks: {
                                color: '#86868b',
                                callback: function (value) { return '$' + value; }
                            },
                            beginAtZero: true
                        }
                    },
                    interaction: { intersect: false, mode: 'index' }
                }
            });

            // Gráfico de Distribución de Inventario (Dona sutil)
            const ctxInventory = document.getElementById('inventoryChart').getContext('2d');
            new Chart(ctxInventory, {
                type: 'doughnut',
                data: {
                    labels: inventoryData.labels,
                    datasets: [{
                        data: inventoryData.data,
                        backgroundColor: [
                            '#0071e3', // Figuras: Azul
                            '#34c759', // Pinturas: Verde
                            '#ff9500'  // Paquetes: Naranja
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%', // Agujero interior grande para diseño sutil
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                color: '#1d1d1f',
                                font: { size: 13, weight: '500' }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || '';
                                    if (label) label += ': ';
                                    label += context.parsed + ' items';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const htmlElement = document.documentElement;
            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

            function setTheme(theme) {
                htmlElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);

                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');

                if (sunIcon && moonIcon) {
                    if (theme === 'dark') {
                        sunIcon.style.display = 'none';
                        moonIcon.style.display = 'block';
                    } else {
                        sunIcon.style.display = 'block';
                        moonIcon.style.display = 'none';
                    }
                }
            }

            setTheme(savedTheme);

            // Allow toggle clicks from a button
            window.toggleTheme = function () {
                const currentTheme = htmlElement.getAttribute('data-theme');
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            };
        });
    </script>

    <!-- MODAL STOCK CRITICO -->
    <div class="modal-overlay" id="stockModalOverlay">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2>Detalle de Stock Crítico</h2>
                <button class="modal-close-btn" id="closeStockModal" aria-label="Cerrar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($listaStockCritico) && count($listaStockCritico) > 0)
                    <ul class="critical-list">
                        @foreach($listaStockCritico as $item)
                            <li class="critical-item">
                                <div class="critical-item-info">
                                    <span class="critical-item-name">{{ $item['name'] }}</span>
                                    <span class="critical-item-type">{{ $item['tipo'] }} | Proveedor: {{ $item['proveedor'] }}</span>
                                </div>
                                <span class="critical-item-stock">{{ $item['stock'] }} en stock</span>
                            </li>
                        @endforeach
                    </ul>
                    <div style="margin-top: 24px; text-align: center;">
                        <a href="{{ route('purchase-orders.preview') }}" style="display: inline-block; padding: 12px 24px; background-color: var(--primary-color); color: white; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 15px; transition: var(--transition); width: 100%; box-sizing: border-box;">Generar Órdenes de Compra</a>
                    </div>
                @else
                    <div style="text-align: center; color: var(--text-muted); padding: 20px 0;">
                        <svg style="margin-bottom: 12px; color: #34c759;" xmlns="http://www.w3.org/2000/svg" width="48"
                            height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <p style="margin: 0; font-size: 15px;">Inventario en óptimas condiciones.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Lógica para el modal de stock crítico
            const stockCard = document.getElementById('stockCriticoCard');
            const modalOverlay = document.getElementById('stockModalOverlay');
            const closeBtn = document.getElementById('closeStockModal');

            if (stockCard && modalOverlay && closeBtn) {
                // Abrir modal
                stockCard.addEventListener('click', () => {
                    modalOverlay.style.display = 'flex';
                    // Pequeño delay para que la transición de opacidad funcione
                    setTimeout(() => {
                        modalOverlay.classList.add('active');
                    }, 10);
                });

                // Función para cerrar modal
                const closeModal = () => {
                    modalOverlay.classList.remove('active');
                    setTimeout(() => {
                        modalOverlay.style.display = 'none';
                    }, 300); // Mismo tiempo que la transición CSS
                };

                // Cerrar al click en el botón X
                closeBtn.addEventListener('click', closeModal);

                // Cerrar al click en el fondo oscuro
                modalOverlay.addEventListener('click', closeModal);
            }
        });
    </script>
</body>

</html>