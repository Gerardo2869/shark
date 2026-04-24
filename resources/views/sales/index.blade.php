<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
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

        .amount {
            font-weight: 600;
            color: var(--text-color);
        }

        .pagination-wrapper {
            margin-top: 24px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            background-color: #f5f5f7;
            color: #1d1d1f;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <h1>Historial de Ventas</h1>
                <a href="{{ url('/paints') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    Ir a Pinturas
                </a>
                <a href="{{ url('/figures') }}"
                    style="font-size: 14px; color: var(--primary-color); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                    Ir a Figuras
                </a>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('sales.create') }}" class="add-btn">Nueva Venta</a>
                <a href="{{ route('profile.edit') }}" class="edit-btn" style="color: var(--text-color);">Mi Perfil</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="edit-btn" style="border: none; cursor: pointer; color: #d93d3b;">Cerrar Sesión</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div style="background-color: #e5f6e8; border: 1px solid #ccebd2; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; color: #1a7a36; font-size: 14px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Vendedor</th>
                        <th>Artículos</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td>#{{ $sale->id }}</td>
                            <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>
                                <span class="status-badge">
                                    {{ $sale->items->count() }} {{ $sale->items->count() == 1 ? 'artículo' : 'artículos' }}
                                </span>
                            </td>
                            <td class="amount">${{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No se han registrado ventas aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $sales->links() }}
        </div>
    </div>

</body>

</html>
