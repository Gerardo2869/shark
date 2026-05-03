<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            --expired-color: #d93d3b;
            --pending-color: #f5a623;
            --converted-color: #1a7a36;
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

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-pending { background-color: #fff7ed; color: #c2410c; }
        .status-converted { background-color: #e5f6e8; color: #1a7a36; }
        .status-expired { background-color: #fceceb; color: #d93d3b; }

        .view-details-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--primary-color);
            background-color: transparent;
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .view-details-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 650px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transform: scale(0.9);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .modal-body {
            padding: 24px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-label {
            color: var(--text-muted);
        }

        .detail-value {
            font-weight: 500;
        }

        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .modal-table th {
            text-align: left;
            font-size: 12px;
            padding: 12px 8px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
        }

        .modal-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f2;
        }

        .modal-footer {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            background-color: #fafafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-total-amount {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; gap: 16px;">
                <h1>Cotizaciones</h1>
                <a href="{{ url('/paints') }}" style="font-size: 14px; color: var(--primary-color); text-decoration: none;">Pinturas</a>
                <a href="{{ url('/figures') }}" style="font-size: 14px; color: var(--primary-color); text-decoration: none;">Figuras</a>
                <a href="{{ url('/sales') }}" style="font-size: 14px; color: var(--primary-color); text-decoration: none;">Ventas</a>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('quotes.create') }}" class="add-btn">Nueva Cotización</a>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="edit-btn" style="border: none; cursor: pointer; color: #d93d3b;">Salir</button>
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
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Expira</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotes as $quote)
                        @php
                            $isExpired = $quote->isExpired();
                            $status = $isExpired ? 'expired' : $quote->status;
                        @endphp
                        <tr>
                            <td>#{{ $quote->id }}</td>
                            <td>{{ $quote->client_name ?: 'Sin nombre' }}</td>
                            <td>{{ $quote->created_at->format('d/m/Y') }}</td>
                            <td style="{{ $isExpired ? 'color: var(--expired-color); font-weight: 600;' : '' }}">
                                {{ $quote->expires_at->format('d/m/Y') }}
                            </td>
                            <td class="amount">${{ number_format($quote->total_amount, 2) }}</td>
                            <td>
                                <span class="status-badge status-{{ $status }}">
                                    {{ $status === 'pending' ? 'Pendiente' : ($status === 'converted' ? 'Vendido' : 'Expirada') }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button type="button" class="view-details-btn" onclick="openQuoteModal({{ json_encode($quote->load('items.quotable', 'user')) }})">
                                        Ver
                                    </button>
                                    <a href="{{ route('quotes.edit', $quote->id) }}" class="edit-btn" style="background-color: #f0f0f2; color: var(--text-color); padding: 6px 12px; font-size: 13px; border-radius: 10px;">
                                        Editar
                                    </a>
                                    @if($status === 'pending')
                                        <form action="{{ route('quotes.convert', $quote->id) }}" method="POST" style="display: inline;" class="convert-form">
                                            @csrf
                                            <button type="button" class="view-details-btn" style="background-color: var(--converted-color); color: white; border: none;" onclick="confirmConversion(this)">
                                                Vender
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cotización?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="edit-btn" style="color: var(--expired-color); border: none; cursor: pointer; background: none; padding: 6px;">
                                            Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                                No hay cotizaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper" style="margin-top: 24px;">
            {{ $quotes->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="quoteModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Cotización #</h2>
                <button class="close-modal" onclick="closeQuoteModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <span class="detail-label">Cliente:</span>
                    <span class="detail-value" id="modalClient"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Vendedor:</span>
                    <span class="detail-value" id="modalUser"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Expira el:</span>
                    <span class="detail-value" id="modalExpires"></span>
                </div>

                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th style="text-align: center;">Cant.</th>
                            <th style="text-align: right;">Precio</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="modalTableBody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div id="modalConvertAction">
                    <!-- Convert button injected here -->
                </div>
                <div>
                    <span class="detail-label">Total</span>
                    <span class="modal-total-amount" id="modalTotal"></span>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openQuoteModal(quote) {
            document.getElementById('modalTitle').textContent = `Cotización #${quote.id}`;
            document.getElementById('modalClient').textContent = quote.client_name || 'N/A';
            document.getElementById('modalUser').textContent = quote.user.name;
            document.getElementById('modalExpires').textContent = new Date(quote.expires_at).toLocaleDateString('es-ES');
            document.getElementById('modalTotal').textContent = `$${parseFloat(quote.total_amount).toLocaleString('en-US', {minimumFractionDigits: 2})}`;

            const tbody = document.getElementById('modalTableBody');
            tbody.innerHTML = '';

            const convertDiv = document.getElementById('modalConvertAction');
            convertDiv.innerHTML = '';

            if (quote.status === 'pending' && new Date(quote.expires_at) > new Date()) {
                convertDiv.innerHTML = `
                    <form action="/quotes/${quote.id}/convert" method="POST" class="convert-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="add-btn" style="background-color: var(--converted-color); border: none; cursor: pointer;" onclick="confirmConversion(this)">
                            Confirmar Venta
                        </button>
                    </form>
                `;
            }

            quote.items.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${item.quotable ? item.quotable.name : 'N/A'}</td>
                    <td style="text-align: center;">${item.quantity}</td>
                    <td style="text-align: right;">$${parseFloat(item.unit_price).toFixed(2)}</td>
                    <td style="text-align: right;">$${parseFloat(item.subtotal).toFixed(2)}</td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('quoteModal').classList.add('active');
        }

        function confirmConversion(button) {
            if (typeof Swal === 'undefined') {
                if (confirm('¿Estás seguro de convertir esta cotización en una venta?')) {
                    button.closest('form').submit();
                }
                return;
            }

            Swal.fire({
                title: '¿Convertir en Venta?',
                text: '¿Estás seguro de finalizar esta venta? El stock de los productos se descontará automáticamente.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1a7a36',
                cancelButtonColor: '#86868b',
                confirmButtonText: 'Sí, vender ahora',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = button.closest('form');
                    if (form) form.submit();
                }
            });
        }

        function closeQuoteModal() {
            document.getElementById('quoteModal').classList.remove('active');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) closeQuoteModal();
        }

        @if (session('success'))
            Swal.fire({
                title: '¡Éxito!',
                text: {!! json_encode(session('success')) !!},
                icon: 'success',
                confirmButtonColor: '#0071e3',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm'
                }
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: 'Error',
                text: {!! json_encode($errors->first()) !!},
                icon: 'error',
                confirmButtonColor: '#d93d3b',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm'
                }
            });
        @endif
    </script>
</body>
</html>
