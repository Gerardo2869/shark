<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Figuras</title>
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
                <h1>Inventario de Figuras</h1>
                <a href="{{ url('/paints') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Ir a Pinturas
                </a>
            </div>
            <button type="button" class="add-btn" onclick="openCreateModal()"
                style="border: none; cursor: pointer;">Nueva Figura</button>
        </div>

        <div class="search-container">
            <form action="{{ route('figures.index') }}" method="GET" class="search-form">
                <div class="search-main-row">
                    <div class="search-group" style="flex: 2; min-width: 250px;">
                        <label for="search" style="display: none;">Buscar</label>
                        <input type="text" id="search" name="search" class="search-input"
                            placeholder="Buscar por nombre, facción o tipo..." value="{{ request('search') }}"
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
                        @if(request()->anyFilled(['search', 'sort_by', 'faction', 'condition', 'is_active', 'stock_level']))
                            <a href="{{ route('figures.index') }}" class="edit-btn pill-btn"
                                style="text-decoration: none; border: 1px solid var(--border-color); display: flex; align-items: center; height: 100%;">Limpiar</a>
                        @endif
                    </div>
                </div>

                <div class="advanced-filters" id="advancedFilters">
                    <div class="search-group">
                        <label for="faction">Facción</label>
                        <input type="text" id="faction" name="faction" class="search-input"
                            placeholder="Ej. Space Marines" value="{{ request('faction') }}">
                    </div>

                    <div class="search-group">
                        <label for="condition">Estado</label>
                        <select id="condition" name="condition" class="search-select">
                            <option value="all">Todos</option>
                            <option value="En matriz" {{ request('condition') == 'En matriz' ? 'selected' : '' }}>En
                                matriz (Sprue)</option>
                            <option value="Ensamblado" {{ request('condition') == 'Ensamblado' ? 'selected' : '' }}>
                                Ensamblado</option>
                            <option value="Imprimado" {{ request('condition') == 'Imprimado' ? 'selected' : '' }}>
                                Imprimado (Primed)</option>
                            <option value="Pintado" {{ request('condition') == 'Pintado' ? 'selected' : '' }}>Pintado
                            </option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="is_active">Visibilidad</label>
                        <select id="is_active" name="is_active" class="search-select">
                            <option value="all">Todos</option>
                            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Activos</option>
                            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Ocultos</option>
                        </select>
                    </div>

                    <div class="search-group">
                        <label for="stock_level">Inventario</label>
                        <select id="stock_level" name="stock_level" class="search-select">
                            <option value="all">Todo</option>
                            <option value="in_stock" {{ request('stock_level') == 'in_stock' ? 'selected' : '' }}>En Stock
                            </option>
                            <option value="low" {{ request('stock_level') == 'low' ? 'selected' : '' }}>Stock Bajo (1-2)
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
                            <option value="faction" {{ request('sort_by') == 'faction' ? 'selected' : '' }}>Facción
                            </option>
                            <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stock</option>
                            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Precio</option>
                            <option value="points" {{ request('sort_by') == 'points' ? 'selected' : '' }}>Puntos</option>
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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Facción</th>
                        <th>Tipo Unidad</th>
                        <th>Estado</th>
                        <th>Pts</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Visibilidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($figures as $figure)
                        <tr>
                            <td>{{ $figure->id }}</td>
                            <td>
                                @if($figure->image)
                                    <img src="{{ asset('storage/' . $figure->image) }}" alt="Imagen de {{ $figure->name }}"
                                        style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px; display: block;">
                                @else
                                    <div
                                        style="width: 48px; height: 48px; background-color: var(--input-bg); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 10px; text-align: center; border: 1px dashed var(--border-color);">
                                        Sin img</div>
                                @endif
                            </td>
                            <td><strong>{{ $figure->name }}</strong></td>
                            <td>{{ $figure->faction ?: 'N/A' }}</td>
                            <td>{{ $figure->unit_type ?: 'N/A' }}</td>
                            <td>{{ $figure->condition ?: 'N/A' }}</td>
                            <td>{{ $figure->points ?: '-' }}</td>
                            <td class="{{ $figure->stock <= 2 ? 'stock-low' : '' }}">{{ $figure->stock }}</td>
                            <td>{{ $figure->price ? '$' . number_format($figure->price, 2) : 'N/A' }}</td>
                            <td>
                                @if($figure->is_active)
                                    <span class="status-badge status-active">Activo</span>
                                @else
                                    <span class="status-badge status-inactive">Oculto</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="edit-btn" style="border: none; cursor: pointer;"
                                    data-figure="{{ json_encode($figure) }}" onclick="openEditModal(this)">Editar</button>
                                <form action="{{ route('figures.destroy', $figure->id) }}" method="POST"
                                    style="display:inline-block;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn"
                                        onclick="confirmDelete(this, '{{ addslashes($figure->name) }}')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No se encontraron figuras con esos criterios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $figures->withQueryString()->links() }}
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

            function confirmDelete(button, figureName) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    html: 'Esto eliminará la figura <strong>' + figureName + '</strong> del inventario.',
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

        function getFormHtml(figure = null) {
            const action = figure ? '/figures/' + figure.id : '/figures';

            return `
            <form method="POST" action="${action}" id="figureForm" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                ${figure ? '<input type="hidden" name="_method" value="PUT">' : ''}
                
                <div class="form-group">
                    <label for="name">Nombre de Figura / Unidad</label>
                    <input id="name" name="name" type="text" placeholder="Ej. Space Marine Intercessors" required value="${figure && figure.name ? figure.name.replace(/"/g, '&quot;') : ''}">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="faction">Facción</label>
                        <input id="faction" name="faction" type="text" placeholder="Ej. Ultramarines" value="${figure && figure.faction ? figure.faction.replace(/"/g, '&quot;') : ''}">
                    </div>

                    <div class="form-group">
                        <label for="unit_type">Tipo de Unidad</label>
                        <select id="unit_type" name="unit_type">
                            <option value="">Seleccionar...</option>
                            <option value="HQ" ${figure && figure.unit_type === 'HQ' ? 'selected' : ''}>HQ</option>
                            <option value="Troops" ${figure && figure.unit_type === 'Troops' ? 'selected' : ''}>Troops</option>
                            <option value="Elites" ${figure && figure.unit_type === 'Elites' ? 'selected' : ''}>Elites</option>
                            <option value="Fast Attack" ${figure && figure.unit_type === 'Fast Attack' ? 'selected' : ''}>Fast Attack</option>
                            <option value="Heavy Support" ${figure && figure.unit_type === 'Heavy Support' ? 'selected' : ''}>Heavy Support</option>
                            <option value="Lord of War" ${figure && figure.unit_type === 'Lord of War' ? 'selected' : ''}>Lord of War</option>
                            <option value="Other" ${figure && figure.unit_type === 'Other' ? 'selected' : ''}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="condition">Estado de Pintado/Armado</label>
                        <select id="condition" name="condition">
                            <option value="">Seleccionar...</option>
                            <option value="En matriz" ${figure && figure.condition === 'En matriz' ? 'selected' : ''}>En matriz (Sprue)</option>
                            <option value="Ensamblado" ${figure && figure.condition === 'Ensamblado' ? 'selected' : ''}>Ensamblado</option>
                            <option value="Imprimado" ${figure && figure.condition === 'Imprimado' ? 'selected' : ''}>Imprimado</option>
                            <option value="Pintado" ${figure && figure.condition === 'Pintado' ? 'selected' : ''}>Pintado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="material">Material</label>
                        <select id="material" name="material">
                            <option value="">Seleccionar...</option>
                            <option value="Plastic" ${figure && figure.material === 'Plastic' ? 'selected' : ''}>Plástico</option>
                            <option value="Resin" ${figure && figure.material === 'Resin' ? 'selected' : ''}>Resina (Forge World/Finecast)</option>
                            <option value="Metal" ${figure && figure.material === 'Metal' ? 'selected' : ''}>Metal</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock">Stock (Cajas/Modelos)</label>
                        <input id="stock" name="stock" type="number" placeholder="0" min="0" required value="${figure && figure.stock !== null ? figure.stock : ''}">
                    </div>

                    <div class="form-group">
                        <label for="price">Valor ($) Opcional</label>
                        <input id="price" name="price" type="number" step="0.01" placeholder="0.00" min="0" value="${figure && figure.price !== null ? figure.price : ''}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="points">Puntos en Juego (Opcional)</label>
                        <input id="points" name="points" type="number" placeholder="Ej. 120" value="${figure && figure.points !== null ? figure.points : ''}">
                    </div>

                    <div class="form-group">
                        <label for="base_size">Tamaño Base (Opcional)</label>
                        <input id="base_size" name="base_size" type="text" placeholder="Ej. 32mm" value="${figure && figure.base_size ? figure.base_size.replace(/"/g, '&quot;') : ''}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="image">Imagen (Opcional)</label>
                        <input id="image" name="image" type="file" accept="image/*" style="padding: 9px 16px;">
                        ${figure && figure.image ? `<div style="margin-top: 8px; font-size: 12px; color: var(--text-muted);">Ya tiene una imagen. Sube una nueva para reemplazarla.</div>` : ''}
                    </div>

                    <div class="form-group">
                        <label for="is_active">Visibilidad</label>
                        <select id="is_active" name="is_active" required>
                            <option value="1" ${figure && figure.is_active == 1 ? 'selected' : (!figure ? 'selected' : '')}>Activo</option>
                            <option value="0" ${figure && figure.is_active == 0 ? 'selected' : ''}>Oculto</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="swal-submit-btn">${figure ? 'Actualizar Figura' : 'Guardar Figura'}</button>
            </form>
            `;
        }

        function openCreateModal() {
            Swal.fire({
                title: 'Nueva Figura / Unidad',
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
            const figure = JSON.parse(button.getAttribute('data-figure'));
            Swal.fire({
                title: 'Editar Figura',
                html: getFormHtml(figure),
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
                (params.has('faction') && params.get('faction') !== '') ||
                (params.has('condition') && params.get('condition') !== 'all') ||
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