<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Shark Inventory</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --primary-color: #0071e3;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
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

        @media (max-width: 768px) {
            .launchpad-grid {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Command Center</h1>
            <p>Gestiona tu inventario y ventas con precisión.</p>
        </header>

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
            <h3>Administración</h3>
            <div class="small-grid">
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
</body>

</html>