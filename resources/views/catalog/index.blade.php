<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo | Shark Inventory</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --border-color: #d2d2d7;
            --primary-color: #0071e3;
            --primary-hover: #0077ed;
            --nav-bg: rgba(255, 255, 255, 0.8);
            --input-bg: #ffffff;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-color: #000000;
            --text-color: #f5f5f7;
            --text-muted: #a1a1a6;
            --card-bg: #1c1c1e;
            --border-color: #38383a;
            --primary-color: #0a84ff;
            --primary-hover: #409cff;
            --nav-bg: rgba(28, 28, 30, 0.8);
            --input-bg: #2c2c2e;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        .navbar {
            background-color: var(--nav-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar h1 {
            margin: 0;
            font-size: 19px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-container {
            position: relative;
            width: 300px;
        }

        .search-input {
            width: 100%;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 8px 12px 8px 36px;
            font-size: 14px;
            color: var(--text-color);
            outline: none;
            transition: var(--transition);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .theme-toggle {
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

        .theme-toggle:hover {
            background-color: rgba(128, 128, 128, 0.1);
        }

        .login-link {
            text-decoration: none;
            color: white;
            background-color: var(--primary-color);
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 18px;
            transition: var(--transition);
        }

        .login-link:hover {
            background-color: var(--primary-hover);
            transform: scale(1.02);
        }

        .contact-link {
            text-decoration: none;
            color: var(--primary-color);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: rgba(0, 113, 227, 0.1);
            border: 1.5px solid rgba(0, 113, 227, 0.2);
            transition: var(--transition);
            position: relative;
            animation: pulse-blue 2s infinite;
        }

        @keyframes pulse-blue {
            0% { box-shadow: 0 0 0 0 rgba(0, 113, 227, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(0, 113, 227, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 113, 227, 0); }
        }

        .contact-link:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 113, 227, 0.4);
            border-color: var(--primary-color);
            animation: none;
        }

        [data-theme="dark"] .contact-link {
            background-color: rgba(0, 113, 227, 0.15);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .welcome-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .welcome-header h2 {
            font-size: 56px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--text-color) 0%, var(--text-muted) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-header p {
            font-size: 24px;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            font-weight: 500;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 32px;
        }

        .item-card {
            background-color: var(--card-bg);
            border-radius: 22px;
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid transparent;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .item-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
            border-color: var(--border-color);
        }

        .image-container {
            width: 100%;
            height: 300px;
            background-color: #f2f2f2;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        [data-theme="dark"] .image-container {
            background-color: #2c2c2e;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .item-card:hover .image-container img {
            transform: scale(1.08);
        }

        .paint-preview {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .color-blob {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            filter: blur(15px);
            opacity: 0.6;
            position: absolute;
        }

        .color-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 4px solid white;
        }

        .item-info {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .item-type-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
            background-color: var(--bg-color);
            color: var(--text-muted);
        }

        .item-category {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
        }

        .item-name {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 16px 0;
            line-height: 1.1;
        }

        .item-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-price {
            font-size: 20px;
            font-weight: 700;
        }

        .item-stock {
            font-size: 13px;
            color: var(--text-muted);
            background-color: var(--bg-color);
            padding: 4px 10px;
            border-radius: 12px;
        }

        .no-results {
            text-align: center;
            padding: 100px 0;
            grid-column: 1 / -1;
            display: none;
        }

        .promo-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: linear-gradient(135deg, #ff3b30 0%, #ff9500 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.05em;
            z-index: 10;
            box-shadow: 0 4px 10px rgba(255, 59, 48, 0.3);
            text-transform: uppercase;
        }

        .item-description {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 16px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Filter Bar Styles */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-pill {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 8px 24px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            user-select: none;
        }

        .filter-pill:hover {
            border-color: var(--primary-color);
            background-color: var(--bg-color);
        }

        .filter-pill.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 113, 227, 0.3);
        }

        [data-theme="dark"] .filter-pill.active {
            box-shadow: 0 4px 12px rgba(10, 132, 255, 0.3);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 20px;
            }

            .search-container {
                display: none;
                /* Hide on small mobile, or move to a second row */
            }

            .welcome-header h2 {
                font-size: 38px;
            }

            .welcome-header p {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <h1>Shark Inventory</h1>
        </div>

        <div class="nav-actions">
            <div class="search-container">
                <span class="search-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <input type="text" id="magicSearch" class="search-input"
                    placeholder="Buscar por nombre, facción o tipo...">
            </div>

            <button id="themeToggle" class="theme-toggle" aria-label="Cambiar tema">
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

            <a href="https://www.twitch.tv/shadowshark2869" target="_blank" class="contact-link" title="Contactar para comprar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
                <span>¡Haz tu pedido!</span>
            </a>

            <a href="{{ route('login') }}" class="login-link">Iniciar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <header class="welcome-header">
            <h2>Colección Completa</h2>
            <p>Descubre nuestras piezas exclusivas y pinturas de alta calidad.</p>
        </header>

        <div class="filter-container" id="filterBar">
            <button class="filter-pill active" data-filter="all">Todo</button>
            <button class="filter-pill" data-filter="figura">Figuras</button>
            <button class="filter-pill" data-filter="pintura">Pinturas</button>
            <button class="filter-pill" data-filter="paquete (kit)">Paquetes</button>
        </div>

        <div class="gallery-grid" id="galleryGrid">
            @forelse($items as $item)
                <div class="item-card" data-name="{{ strtolower($item['name']) }}"
                    data-category="{{ strtolower($item['category']) }}" data-type="{{ strtolower($item['type']) }}">
                    <div class="image-container">
                        @if($item['is_bundle'])
                            <div class="promo-badge">Ahorro</div>
                        @endif
                        @if($item['image'])
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" loading="lazy">
                        @elseif($item['hex_color'])
                            <div class="paint-preview">
                                <div class="color-blob" style="background-color: {{ $item['hex_color'] }};"></div>
                                <div class="color-circle" style="background-color: {{ $item['hex_color'] }};"></div>
                            </div>
                        @else
                            <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">
                                Sin vista previa
                            </div>
                        @endif
                    </div>
                    <div class="item-info">
                        <span class="item-type-tag">{{ $item['type'] }}</span>
                        <div class="item-category">{{ $item['category'] }}</div>
                        <h3 class="item-name">{{ $item['name'] }}</h3>

                        @if($item['is_bundle'] && isset($item['description']))
                            <div class="item-description">{{ $item['description'] }}</div>
                        @endif

                        <div class="item-footer">
                            <span class="item-price">${{ number_format($item['price'], 2) }}</span>
                            @if(!$item['is_bundle'])
                                <span class="item-stock">{{ $item['stock'] }} en stock</span>
                            @else
                                <span class="item-stock" style="background-color: #eef7ff; color: var(--primary-color);">Kit
                                    Especial</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-results" style="display: block;">
                    <h3>No hay artículos disponibles en este momento.</h3>
                    <p>Vuelve pronto para ver nuestras novedades.</p>
                </div>
            @endforelse
            <div id="noResults" class="no-results">
                <h3>No se encontraron resultados</h3>
                <p>Intenta con otros términos de búsqueda.</p>
            </div>
        </div>
    </div>

    <script>
        // Filtering State
        let activeFilter = 'all';
        let searchQuery = '';

        const searchInput = document.getElementById('magicSearch');
        const filterButtons = document.querySelectorAll('.filter-pill');
        const cards = document.querySelectorAll('.item-card');
        const noResults = document.getElementById('noResults');

        // Combined Filter Function
        function applyFilters() {
            let hasVisibleCards = false;

            cards.forEach(card => {
                const name = card.dataset.name;
                const category = card.dataset.category;
                const type = card.dataset.type;

                const matchesSearch = !searchQuery ||
                    name.includes(searchQuery) ||
                    category.includes(searchQuery) ||
                    type.includes(searchQuery);

                const matchesType = activeFilter === 'all' || type === activeFilter;

                if (matchesSearch && matchesType) {
                    card.style.display = 'flex';
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });

            noResults.style.display = hasVisibleCards ? 'none' : 'block';
        }

        // Search Input Event
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            applyFilters();
        });

        // Filter Buttons Event
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update UI
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Update State
                activeFilter = button.dataset.filter;
                applyFilters();
            });
        });

        // Theme Toggle Logic
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const htmlElement = document.documentElement;

        // Check for saved theme or system preference
        const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });

        function setTheme(theme) {
            htmlElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);

            if (theme === 'dark') {
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            } else {
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            }
        }
    </script>
</body>

</html>