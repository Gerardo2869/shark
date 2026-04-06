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
            --primary-color: #0071e3;
            --primary-hover: #0077ed;
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
            max-width: 1000px;
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

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
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

        button.swal2-confirm, button.swal2-cancel {
            border-radius: 12px !important;
            padding: 12px 24px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Inventario</h1>
            <a href="/paints/create" class="add-btn">Nueva Pintura</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paints as $paint)
                        <tr>
                            <td>{{ $paint->id }}</td>
                            <td><strong>{{ $paint->name }}</strong></td>
                            <td>{{ $paint->brand }}</td>
                            <td style="text-transform: capitalize;">{{ $paint->color_type }}</td>
                            <td class="{{ $paint->stock <= 5 ? 'stock-low' : '' }}">{{ $paint->stock }}</td>
                            <td>${{ number_format($paint->price, 2) }}</td>
                            <td>
                                @if($paint->is_active)
                                    <span class="status-badge status-active">Activo</span>
                                @else
                                    <span class="status-badge status-inactive">Desc.</span>
                                @endif
                            </td>
                            <td>
                                <a href="/paints/{{ $paint->id }}/edit" class="edit-btn">Editar</a>
                                <form action="{{ route('paints.destroy', $paint->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn" onclick="confirmDelete(this, '{{ addslashes($paint->name) }}')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No hay pinturas registradas en el inventario.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
    </script>
</body>

</html>