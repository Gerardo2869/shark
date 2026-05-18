<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Paquetes</title>
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
            max-width: 1100px;
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

        .nav-links {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .nav-links a {
            font-size: 14px;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
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
            border: none;
            cursor: pointer;
        }

        .add-btn:hover {
            background-color: var(--primary-hover);
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

        .bundle-image {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
        }

        .component-tag {
            display: inline-block;
            padding: 2px 8px;
            background-color: #f0f0f2;
            border-radius: 6px;
            font-size: 12px;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .delete-btn {
            color: #d93d3b;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="{{ route('admin.dashboard') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 6px; background: #f2f2f7; padding: 8px 16px; border-radius: 12px; transition: all 0.2s ease; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Dashboard
                </a>
                <h1 style="margin: 0; font-size: 24px; font-weight: 600; letter-spacing: -0.015em;">Gestión de Paquetes (Bundles)</h1>
            </div>
            <a href="{{ route('bundles.create') }}" class="add-btn">Nuevo Paquete</a>
        </div>

        @if(session('success'))
            <div style="background-color: #e5f6e8; color: #1a7a36; padding: 12px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Componentes</th>
                        <th>Precio Especial</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bundles as $bundle)
                        <tr>
                            <td>
                                @if($bundle->image)
                                    <img src="{{ asset('storage/' . $bundle->image) }}" class="bundle-image">
                                @else
                                    <div class="bundle-image" style="display: flex; align-items: center; justify-content: center; font-size: 10px; color: var(--text-muted);">Sin img</div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $bundle->name }}</strong>
                                <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">{{ Str::limit($bundle->description, 50) }}</div>
                            </td>
                            <td>
                                @foreach($bundle->items as $item)
                                    <span class="component-tag">
                                        {{ $item->quantity }}x {{ $item->sellable->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td style="font-weight: 600; color: var(--primary-color);">
                                ${{ number_format($bundle->price, 2) }}
                            </td>
                            <td>
                                <form action="{{ route('bundles.destroy', $bundle->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este paquete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">No hay paquetes creados todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 24px;">
            {{ $bundles->links() }}
        </div>
    </div>
</body>
</html>
