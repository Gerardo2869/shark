<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Pinturas</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --border-color: #d2d2d7;
            --input-bg: #f5f5f7;
            --primary-color: #0071e3;
            --primary-hover: #0077ed;
            --focus-ring: rgba(0, 113, 227, 0.4);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 40px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 18px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 1300px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.015em;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            background-color: var(--primary-color);
            text-decoration: none;
            border-radius: 12px;
            transition: background-color 0.2s ease;
        }

        .add-btn:hover {
            background-color: var(--primary-hover);
        }

        .edit-btn {
            display: inline-block;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--primary-color);
            background-color: var(--bg-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .edit-btn:hover {
            background-color: #e5f0fa;
        }

        .delete-btn {
            display: inline-block;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: #d93d3b;
            background-color: var(--bg-color);
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
            margin-left: 6px;
        }

        .delete-btn:hover {
            background-color: #fceceb;
        }

        .search-container {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .search-form {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .search-group {
            flex: 1;
            min-width: 150px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .search-group label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-color);
        }

        .search-input,
        .search-select {
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
            width: 100%;
        }

        .search-input:focus,
        .search-select:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .search-actions {
            display: flex;
            gap: 10px;
        }

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
        }

        .pagination-wrapper .flex.justify-between.flex-1.sm\:hidden {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .pagination-wrapper .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-wrapper p.text-sm.text-gray-700 {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0;
        }

        .pagination-wrapper a,
        .pagination-wrapper span.relative.inline-flex.items-center,
        .pagination-wrapper span[aria-current="page"]>span,
        .pagination-wrapper span[aria-disabled="true"]>span {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .pagination-wrapper a:hover {
            background-color: var(--bg-color);
        }

        .pagination-wrapper span[aria-current="page"]>span {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
            z-index: 1;
        }

        .pagination-wrapper span[aria-disabled="true"]>span {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: var(--bg-color);
        }

        .pagination-wrapper svg {
            width: 16px;
            height: 16px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px {
            display: flex;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>* {
            margin-left: -1px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>*:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .pagination-wrapper .relative.z-0.inline-flex.rounded-md.shadow-sm.-space-x-px>*:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        th {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 14px;
            padding: 16px;
            border-bottom: 1px solid #eaeaea;
            color: var(--text-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background-color: #e5f6e8;
            color: #1a7a36;
        }

        .status-inactive {
            background-color: #fceceb;
            color: #d93d3b;
        }

        .status-warning {
            background-color: #fff7ed;
            color: #c2410c;
        }

        .stock-low {
            color: #d93d3b;
            font-weight: 600;
        }

        /* Apple SweetAlert Style */
        div.swal2-popup {
            border-radius: 18px !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
        }

        button.swal2-confirm,
        button.swal2-cancel {
            border-radius: 12px !important;
            padding: 12px 24px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
        }

        .swal2-html-container-form {
            margin: 1em 0 0 0 !important;
            overflow: hidden !important;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
            flex: 1;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            font-family: inherit;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
            appearance: none;
        }

        .form-group select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2386868b' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .form-group input::placeholder {
            color: var(--text-muted);
        }

        .swal-submit-btn {
            width: 100%;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 12px;
        }

        .swal-submit-btn:hover {
            background-color: var(--primary-hover);
        }

        .swal-submit-btn:active {
            transform: scale(0.98);
        }

        /* Nuevos Estilos para Filtros Avanzados y Tabla */
        .advanced-filters {
            display: none;
            width: 100%;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
            gap: 16px;
            flex-wrap: wrap;
        }

        .advanced-filters.show {
            display: flex;
        }

        .toggle-filters-btn {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .toggle-filters-btn:hover {
            opacity: 0.8;
        }

        .search-main-row {
            display: flex;
            gap: 16px;
            width: 100%;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #fafafc;
        }

        .pill-btn {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <h1>Inventario de Pinturas</h1>
                <a href="{{ url('/figures') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                    Ir a Figuras
                </a>
                <a href="{{ url('/sales') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                    Ir a Ventas
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ url('/users') }}"
                        style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px; margin-left: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Ir a Usuarios
                    </a>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                @if(auth()->user()->isAdmin())
                    <button type="button" class="add-btn" onclick="openCreateModal()"
                        style="border: none; cursor: pointer;">Nueva Pintura</button>
                @endif
                <a href="{{ route('profile.edit') }}" class="edit-btn" style="border: none; cursor: pointer; color: var(--text-color);">Mi Perfil</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="edit-btn" style="border: none; cursor: pointer; color: #d93d3b;">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        @if((isset($outOfStockCount) && $outOfStockCount > 0) || (isset($lowStockCount) && $lowStockCount > 0))
            <div style="background-color: #fff7ed; border: 1px solid #fed7aa; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <div>
                    <h4 style="margin: 0 0 4px 0; color: #9a3412; font-size: 14px; font-weight: 600;">Aviso de Inventario</h4>
                    <p style="margin: 0; color: #c2410c; font-size: 14px; line-height: 1.4;">
                        @if($outOfStockCount > 0 && $lowStockCount > 0)
                            @if($outOfStockCount == 1 && $lowStockCount == 1)
                                Hay <strong>una</strong> pintura agotada y <strong>otra</strong> con poco stock.
                            @elseif($outOfStockCount == 1)
                                Hay <strong>una</strong> pintura agotada y <strong>{{ $lowStockCount }}</strong> con poco stock.
                            @elseif($lowStockCount == 1)
                                Hay <strong>{{ $outOfStockCount }}</strong> pinturas agotadas y <strong>otra</strong> con poco stock.
                            @else
                                Hay <strong>{{ $outOfStockCount }}</strong> pinturas agotadas y <strong>{{ $lowStockCount }}</strong> con poco stock.
                            @endif
                        @elseif($outOfStockCount > 0)
                            Hay <strong>{{ $outOfStockCount == 1 ? 'una' : $outOfStockCount }}</strong> {{ $outOfStockCount == 1 ? 'pintura agotada' : 'pinturas agotadas' }}.
                        @else
                            Hay <strong>{{ $lowStockCount == 1 ? 'una' : $lowStockCount }}</strong> {{ $lowStockCount == 1 ? 'pintura' : 'pinturas' }} con poco stock.
                        @endif
                    </p>
                </div>
            </div>
        @endif

        <div class="search-container">
            <form action="{{ route('paints.index') }}" method="GET" class="search-form">
                <div class="search-main-row">
                    <div class="search-group" style="flex: 2; min-width: 250px;">
                        <label for="search" style="display: none;">Buscar</label>
                        <input type="text" id="search" name="search" class="search-input"
                            placeholder="Buscar por nombre, marca o código..." value="{{ request('search') }}"
                            style="padding: 14px 18px; border-radius: 12px; font-size: 15px;">
                    </div>
                    <div class="search-actions" style="display: flex; align-items: center; gap: 12px;">
                        <button type="submit" class="add-btn pill-btn">Buscar</button>
                        <button type="button" class="toggle-filters-btn" onclick="toggleAdvancedFilters()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            Filtros
                        </button>
                        @if(request()->anyFilled(['search', 'sort_by', 'color_type', 'is_active', 'stock_level']))
                            <a href="{{ route('paints.index') }}" class="edit-btn pill-btn"
                                style="text-decoration: none; border: 1px solid var(--border-color); display: flex; align-items: center; height: 100%;">Limpiar</a>
                        @endif
                    </div>
                </div>

                <div class="advanced-filters" id="advancedFilters">
                    <div class="search-group">
                        <label for="color_type">Tipo de Color</label>
                        <select id="color_type" name="color_type" class="search-select">
                            <option value="all">Todos</option>
                            <option value="base" {{ request('color_type') == 'base' ? 'selected' : '' }}>Base</option>
                            <option value="layer" {{ request('color_type') == 'layer' ? 'selected' : '' }}>Layer</option>
                            <option value="shade" {{ request('color_type') == 'shade' ? 'selected' : '' }}>Shade</option>
                            <option value="dry" {{ request('color_type') == 'dry' ? 'selected' : '' }}>Dry</option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="is_active">Estado</label>
                        <select id="is_active" name="is_active" class="search-select">
                            <option value="all">Todos</option>
                            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Activos</option>
                            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Descontinuados</option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="stock_level">Inventario</label>
                        <select id="stock_level" name="stock_level" class="search-select">
                            <option value="all">Todo</option>
                            <option value="in_stock" {{ request('stock_level') == 'in_stock' ? 'selected' : '' }}>En Stock
                            </option>
                            <option value="low" {{ request('stock_level') == 'low' ? 'selected' : '' }}>Stock Bajo (1-5)
                            </option>
                            <option value="out" {{ request('stock_level') == 'out' ? 'selected' : '' }}>Agotado (0)
                            </option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="sort_by">Ordenar por</label>
                        <select id="sort_by" name="sort_by" class="search-select">
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nombre</option>
                            <option value="brand" {{ request('sort_by') == 'brand' ? 'selected' : '' }}>Marca</option>
                            <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stock</option>
                            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Precio</option>
                            <option value="expiration_date" {{ request('sort_by') == 'expiration_date' ? 'selected' : '' }}>Caducidad</option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="sort_order">Orden</label>
                        <select id="sort_order" name="sort_order" class="search-select">
                            <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>
                                Descendente</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Vol. (ml)</th>
                        <th>Acabado</th>
                        <th>Código</th>
                        <th>Caducidad</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        @if(auth()->user()->isAdmin())
                            <th>Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($paints as $paint)
                        <tr>
                            <td>{{ $paint->id }}</td>
                            <td><strong>{{ $paint->name }}</strong></td>
                            <td>{{ $paint->brand }}</td>
                            <td style="text-transform: capitalize;">{{ $paint->color_type }}</td>
                            <td>{{ $paint->ml ? $paint->ml . ' ml' : 'N/A' }}</td>
                            <td>{{ $paint->finish ?: 'N/A' }}</td>
                            <td>{{ $paint->code ?: 'N/A' }}</td>
                            <td>{{ $paint->expiration_date ? \Carbon\Carbon::parse($paint->expiration_date)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td>
                                <span class="{{ $paint->stock <= 5 ? 'stock-low' : '' }}">{{ $paint->stock }}</span>
                                @if($paint->stock == 0)
                                    <span class="status-badge status-inactive" style="font-size: 11px; padding: 2px 6px; margin-left: 6px;">Agotado</span>
                                @elseif($paint->stock <= 5)
                                    <span class="status-badge status-warning" style="font-size: 11px; padding: 2px 6px; margin-left: 6px;">Poco stock</span>
                                @endif
                            </td>
                            <td>${{ number_format($paint->price, 2) }}</td>
                            <td>
                                @if($paint->is_active)
                                    <span class="status-badge status-active">Activo</span>
                                @else
                                    <span class="status-badge status-inactive">Desc.</span>
                                @endif
                            </td>
                            @if(auth()->user()->isAdmin())
                                <td>
                                    <button type="button" class="edit-btn" style="border: none; cursor: pointer;"
                                        data-paint="{{ json_encode($paint) }}" onclick="openEditModal(this)">Editar</button>
                                    <form action="{{ route('paints.destroy', $paint->id) }}" method="POST"
                                        style="display:inline-block;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn"
                                            onclick="confirmDelete(this, '{{ addslashes($paint->name) }}')">Eliminar</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No se encontraron pinturas con esos criterios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $paints->withQueryString()->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: '¡Completado!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#0071e3'
            });
        @endif

            function confirmDelete(button, paintName) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    html: 'Esto eliminará la pintura <strong>' + paintName + '</strong> del inventario.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d93d3b',
                    cancelButtonColor: '#86868b',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'swal2-popup',
                        confirmButton: 'swal2-confirm',
                        cancelButton: 'swal2-cancel'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('.delete-form').submit();
                    }
                });
            }

        function getFormHtml(paint = null) {
            const action = paint ? '/paints/' + paint.id : '/paints';

            return `
            <form method="POST" action="${action}" id="paintForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                ${paint ? '<input type="hidden" name="_method" value="PUT">' : ''}
                
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" name="name" type="text" placeholder="Ej. Macragge Blue" required value="${paint && paint.name ? paint.name.replace(/"/g, '&quot;') : ''}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="brand">Marca</label>
                        <input id="brand" name="brand" type="text" placeholder="Ej. Citadel" required value="${paint && paint.brand ? paint.brand.replace(/"/g, '&quot;') : ''}">
                    </div>

                    <div class="form-group">
                        <label for="color_type">Tipo de Color</label>
                        <select id="color_type" name="color_type" required>
                            <option value="base" ${paint && paint.color_type === 'base' ? 'selected' : ''}>Base</option>
                            <option value="layer" ${paint && paint.color_type === 'layer' ? 'selected' : ''}>Layer</option>
                            <option value="shade" ${paint && paint.color_type === 'shade' ? 'selected' : ''}>Shade</option>
                            <option value="dry" ${paint && paint.color_type === 'dry' ? 'selected' : ''}>Dry</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input id="stock" name="stock" type="number" placeholder="0" min="0" required value="${paint && paint.stock !== null ? paint.stock : ''}">
                    </div>

                    <div class="form-group">
                        <label for="price">Precio ($)</label>
                        <input id="price" name="price" type="number" step="0.01" placeholder="0.00" min="0" required value="${paint && paint.price !== null ? paint.price : ''}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="expiration_date">Fecha de Caducidad</label>
                        <input id="expiration_date" name="expiration_date" type="date" value="${paint && paint.expiration_date ? paint.expiration_date : ''}">
                    </div>

                    <div class="form-group">
                        <label for="ml">Volumen (ML)</label>
                        <input id="ml" name="ml" type="number" placeholder="Ej. 12" min="1" required value="${paint && paint.ml !== null ? paint.ml : ''}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="finish">Acabado</label>
                        <input id="finish" name="finish" type="text" placeholder="Ej. Mate, Brillante" value="${paint && paint.finish ? paint.finish.replace(/"/g, '&quot;') : ''}">
                    </div>

                    <div class="form-group">
                        <label for="code">Código</label>
                        <input id="code" name="code" type="text" placeholder="Ej. 21-02" value="${paint && paint.code ? paint.code.replace(/"/g, '&quot;') : ''}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="is_active">Estado</label>
                    <select id="is_active" name="is_active" required>
                        <option value="1" ${paint && paint.is_active == 1 ? 'selected' : (!paint ? 'selected' : '')}>Activo</option>
                        <option value="0" ${paint && paint.is_active == 0 ? 'selected' : ''}>Descontinuado</option>
                    </select>
                </div>

                <button type="submit" class="swal-submit-btn">${paint ? 'Actualizar' : 'Guardar'}</button>
            </form>
            `;
        }

        function openCreateModal() {
            Swal.fire({
                title: 'Nueva Pintura',
                html: getFormHtml(),
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-popup',
                    htmlContainer: 'swal2-html-container-form'
                }
            });
        }

        function openEditModal(button) {
            const paint = JSON.parse(button.getAttribute('data-paint'));
            Swal.fire({
                title: 'Editar Pintura',
                html: getFormHtml(paint),
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-popup',
                    htmlContainer: 'swal2-html-container-form'
                }
            });
        }
        function toggleAdvancedFilters() {
            const filters = document.getElementById('advancedFilters');
            filters.classList.toggle('show');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const hasAdvancedFilters =
                (params.has('color_type') && params.get('color_type') !== 'all') ||
                (params.has('is_active') && params.get('is_active') !== 'all') ||
                (params.has('stock_level') && params.get('stock_level') !== 'all') ||
                (params.has('sort_by') && params.get('sort_by') !== 'id') ||
                (params.has('sort_order') && params.get('sort_order') !== 'desc');

            if (hasAdvancedFilters) {
                document.getElementById('advancedFilters').classList.add('show');
            }
        });
    </script>
</body>

</html>