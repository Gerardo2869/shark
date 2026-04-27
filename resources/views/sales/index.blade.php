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
            margin-top: 8px;
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
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: var(--text-color);
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

        .item-detail-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-img {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f5f5f7;
        }

        .item-name {
            font-weight: 600;
            font-size: 14px;
        }

        .item-type {
            font-size: 11px;
            color: var(--text-muted);
        }

        .modal-footer {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            background-color: #fafafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-total-label {
            font-size: 14px;
            color: var(--text-muted);
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
                    <button type="submit" class="edit-btn" style="border: none; cursor: pointer; color: #d93d3b;">Cerrar
                        Sesión</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div
                style="background-color: #e5f6e8; border: 1px solid #ccebd2; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; color: #1a7a36; font-size: 14px;">
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
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <span class="status-badge">
                                        {{ $sale->items->count() }}
                                        {{ $sale->items->count() == 1 ? 'artículo' : 'artículos' }}
                                    </span>
                                    <button type="button" class="view-details-btn"
                                        onclick="openSaleModal({{ json_encode($sale->load('items.sellable')) }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Ver Detalles
                                    </button>
                                </div>
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

    <!-- Modal de Detalles -->
    <div id="saleModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalSaleId">Detalle de Venta #</h2>
                <button class="close-modal" onclick="closeSaleModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <span class="detail-label">Fecha y Hora:</span>
                    <span class="detail-value" id="modalSaleDate"></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Vendedor:</span>
                    <span class="detail-value" id="modalSaleUser"></span>
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
                    <tbody id="modalTableBody">
                        <!-- Items injected here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span class="modal-total-label">Total de la Venta</span>
                <span class="modal-total-amount" id="modalSaleTotal"></span>
            </div>
        </div>
    </div>

    <script>
        const storageUrl = "{{ asset('storage') }}/";

        function openSaleModal(sale) {
            const modal = document.getElementById('saleModal');
            document.getElementById('modalSaleId').textContent = `Detalle de Venta #${sale.id}`;

            const date = new Date(sale.created_at);
            document.getElementById('modalSaleDate').textContent = date.toLocaleString('es-ES', {
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });

            document.getElementById('modalSaleUser').textContent = sale.user.name;
            document.getElementById('modalSaleTotal').textContent = `$${parseFloat(sale.total_amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}`;

            const tbody = document.getElementById('modalTableBody');
            tbody.innerHTML = '';

            sale.items.forEach(item => {
                const tr = document.createElement('tr');

                const typeLabel = item.sellable_type.includes('Figure') ? 'Figura' : 'Pintura';
                let imgHtml = '';

                if (item.sellable && item.sellable.image) {
                    imgHtml = `<img src="${storageUrl + item.sellable.image}" class="item-img" alt="">`;
                } else if (item.sellable_type.includes('Paint') && item.sellable && item.sellable.hex_color) {
                    imgHtml = `<div class="item-img" style="background: ${item.sellable.hex_color}; border: 1px solid rgba(0,0,0,0.1);"></div>`;
                } else {
                    imgHtml = `<div class="item-img" style="background: var(--primary-color); opacity: 0.1; display: flex; align-items: center; justify-content: center; font-size: 10px; color: var(--primary-color);">No img</div>`;
                }

                tr.innerHTML = `
                    <td>
                        <div class="item-detail-info">
                            ${imgHtml}
                            <div>
                                <div class="item-name">${item.sellable ? item.sellable.name : 'Producto no encontrado'}</div>
                                <div class="item-type">${typeLabel}</div>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: center;">${item.quantity}</td>
                    <td style="text-align: right;">$${parseFloat(item.unit_price).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                    <td style="text-align: right; font-weight: 600;">$${parseFloat(item.subtotal).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                `;
                tbody.appendChild(tr);
            });

            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scroll
        }

        function closeSaleModal() {
            const modal = document.getElementById('saleModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close on click outside
        window.onclick = function (event) {
            const modal = document.getElementById('saleModal');
            if (event.target == modal) {
                closeSaleModal();
            }
        }
    </script>

</body>

</html>