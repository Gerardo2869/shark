<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Auditoría</title>
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
            --success-color: #1a7a36;
            --warning-color: #c2410c;
            --danger-color: #d93d3b;
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

        .back-link {
            font-size: 14px;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
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
            vertical-align: top;
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

        .action-created { background-color: #e5f6e8; color: var(--success-color); }
        .action-updated { background-color: #e5f0fa; color: var(--primary-color); }
        .action-deleted { background-color: #fceceb; color: var(--danger-color); }

        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            width: 24px;
            height: 24px;
            background-color: var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            color: white;
        }

        .diff-container {
            font-family: ui-monospace, SFMono-Regular, SF Mono, Menlo, Monaco, Consolas, monospace;
            font-size: 12px;
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 8px;
            max-width: 400px;
            overflow-x: auto;
        }

        .diff-item {
            margin-bottom: 4px;
        }

        .diff-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .diff-old {
            color: #d93d3b;
            text-decoration: line-through;
            background-color: #fceceb;
            padding: 0 2px;
        }

        .diff-new {
            color: #1a7a36;
            background-color: #e5f6e8;
            padding: 0 2px;
        }

        .pagination-wrapper {
            margin-top: 24px;
        }

        /* Re-using pagination styles from other views */
        .pagination-wrapper nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
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
                <h1>Auditoría de Movimientos</h1>
            </div>
            <div>
                <span style="font-size: 13px; color: var(--text-muted);">
                    Registros totales: {{ $movements->total() }}
                </span>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Fecha y Hora</th>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Entidad</th>
                        <th>Descripción</th>
                        <th>Cambios</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $movement)
                        <tr>
                            <td style="white-space: nowrap;">
                                <div style="font-weight: 500;">{{ $movement->created_at->format('d/m/Y') }}</div>
                                <div style="font-size: 12px; color: var(--text-muted);">{{ $movement->created_at->format('H:i:s') }}</div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar" style="background-color: {{ '#' . substr(md5($movement->user->name ?? 'System'), 0, 6) }}">
                                        {{ strtoupper(substr($movement->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 500;">{{ $movement->user->name ?? 'Sistema' }}</div>
                                        <div style="font-size: 11px; color: var(--text-muted);">{{ $movement->user->role ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge action-{{ $movement->action }}">
                                    @switch($movement->action)
                                        @case('created') Creado @break
                                        @case('updated') Actualizado @break
                                        @case('deleted') Eliminado @break
                                        @default {{ ucfirst($movement->action) }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ class_basename($movement->movable_type) }}</div>
                                <div style="font-size: 11px; color: var(--text-muted);">ID: {{ $movement->movable_id }}</div>
                            </td>
                            <td style="max-width: 250px;">
                                {{ $movement->description }}
                            </td>
                            <td>
                                @if($movement->action === 'updated' && $movement->old_values && $movement->new_values)
                                    <div class="diff-container">
                                        @foreach($movement->new_values as $key => $newValue)
                                            @php $oldValue = $movement->old_values[$key] ?? 'N/A'; @endphp
                                            <div class="diff-item">
                                                <span class="diff-label">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                <span class="diff-old">{{ is_array($oldValue) ? json_encode($oldValue) : $oldValue }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 2px; color: var(--text-muted);"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                                <span class="diff-new">{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($movement->action === 'created' && $movement->new_values)
                                    <div style="font-size: 11px; color: var(--text-muted);">Registro inicial completo</div>
                                @elseif($movement->action === 'deleted')
                                    <div style="font-size: 11px; color: var(--danger-color);">Registro eliminado</div>
                                @else
                                    <span style="color: var(--text-muted); font-style: italic; font-size: 12px;">Sin detalles de cambios</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No se han registrado movimientos aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $movements->links() }}
        </div>
    </div>
</body>

</html>
