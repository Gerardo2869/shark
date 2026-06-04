<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Previa de Órdenes de Compra</title>
    <style>
        :root {
            --bg-color: #f5f5f7;
            --text-color: #1d1d1f;
            --text-muted: #86868b;
            --card-bg: #ffffff;
            --primary-color: #0071e3;
            --border-color: rgba(0, 0, 0, 0.05);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #000000;
                --text-color: #f5f5f7;
                --text-muted: #a1a1a6;
                --card-bg: #1c1c1e;
                --border-color: #38383a;
            }
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
            max-width: 900px;
            padding: 60px 20px;
            box-sizing: border-box;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin: 0;
        }
        
        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: var(--transition);
        }
        
        .back-btn:hover {
            opacity: 0.8;
        }

        .supplier-group {
            background-color: var(--card-bg);
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .supplier-group:hover {
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .supplier-name {
            font-size: 24px;
            font-weight: 600;
            margin: 0 0 20px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .supplier-name .icon {
            background: rgba(0, 113, 227, 0.1);
            color: var(--primary-color);
            padding: 8px;
            border-radius: 12px;
            display: flex;
        }

        .action-buttons {
            margin-left: auto;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .config-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: var(--card-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .config-btn:hover {
            background-color: var(--bg-color);
            transform: translateY(-1px);
        }

        .download-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .download-btn:hover {
            background-color: #005bb5;
            transform: translateY(-1px);
        }

        .send-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background-color: #34c759;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
        }

        .send-btn:hover {
            background-color: #248a3d;
            transform: translateY(-1px);
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th, .items-table td {
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        .items-table th {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            font-size: 15px;
        }

        .item-type {
            font-size: 13px;
            color: var(--text-muted);
        }

        .item-stock {
            color: #ff3b30;
            font-weight: 600;
            background: rgba(255, 59, 48, 0.1);
            padding: 4px 10px;
            border-radius: 8px;
        }

        /* --- MODAL --- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 24px;
            width: 90%;
            max-width: 400px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            transform: scale(0.95);
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 16px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-color);
            color: var(--text-color);
            font-size: 15px;
            box-sizing: border-box;
            outline: none;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 113, 227, 0.1);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-cancel {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 16px;
        }

        .btn-save {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 20px;
            transition: var(--transition);
        }

        .btn-save:hover {
            background-color: #005bb5;
        }

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Generación de Órdenes</h1>
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Volver al Dashboard
            </a>
        </header>

        @if(session('success'))
            <div style="background-color: rgba(52, 199, 89, 0.1); color: #248a3d; padding: 16px 24px; border-radius: 16px; margin-bottom: 32px; font-weight: 500; border: 1px solid rgba(52, 199, 89, 0.2);">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: rgba(255, 59, 48, 0.1); color: #c93429; padding: 16px 24px; border-radius: 16px; margin-bottom: 32px; font-weight: 500; border: 1px solid rgba(255, 59, 48, 0.2);">
                {{ session('error') }}
            </div>
        @endif


        @forelse($groupedBySupplier as $supplierName => $items)
            <div class="supplier-group">
                <h2 class="supplier-name">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="8" width="18" height="12" rx="2" ry="2"></rect>
                            <line x1="16" y1="8" x2="16" y2="2"></line>
                            <line x1="8" y1="8" x2="8" y2="4"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                        </svg>
                    </div>
                    <div class="action-buttons">
                        @if(isset($suppliers[$supplierName]))
                        <button type="button" class="config-btn" onclick="openEmailModal({{ $suppliers[$supplierName]->id }}, '{{ $suppliers[$supplierName]->name }}', '{{ $suppliers[$supplierName]->email }}')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            {{ $suppliers[$supplierName]->email ? 'Editar Correo' : 'Configurar Correo' }}
                        </button>
                        @endif
                        <a href="{{ route('purchase-orders.send-email', $supplierName) }}" class="send-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                            Enviar Correo
                        </a>
                        <a href="{{ route('purchase-orders.download', $supplierName) }}" class="download-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Descargar PDF
                        </a>
                    </div>
                </h2>
                
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th style="text-align: right;">Stock Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="item-name">{{ $item['name'] }}</div>
                            </td>
                            <td>
                                <div class="item-type">{{ $item['type'] }}</div>
                            </td>
                            <td style="text-align: right;">
                                <span class="item-stock">{{ $item['stock'] }} un.</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div style="text-align: center; padding: 60px; background: var(--card-bg); border-radius: 24px; border: 1px solid var(--border-color);">
                <svg style="color: #34c759; margin-bottom: 16px;" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <h3 style="margin: 0 0 8px 0; font-size: 20px;">Todo en orden</h3>
                <p style="color: var(--text-muted); margin: 0;">No hay productos con stock crítico en este momento.</p>
            </div>
        @endforelse
    </div>

    <!-- Email Modal -->
    <div class="modal-overlay" id="emailModal" onclick="closeEmailModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <h3 class="modal-title" id="emailModalTitle">Configurar Correo</h3>
            <form id="emailForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="supplierEmail">Correo Electrónico</label>
                    <input type="email" name="email" id="supplierEmail" placeholder="ejemplo@proveedor.com" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeEmailModal()">Cancelar</button>
                    <button type="submit" class="btn-save">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEmailModal(id, name, email) {
            document.getElementById('emailModalTitle').innerText = 'Correo de ' + name;
            document.getElementById('supplierEmail').value = email || '';
            document.getElementById('emailForm').action = '/suppliers/' + id + '/email';
            
            const modal = document.getElementById('emailModal');
            modal.style.display = 'flex';
            // Force reflow
            void modal.offsetWidth;
            modal.classList.add('active');
        }

        function closeEmailModal(event) {
            if (event && event.target !== document.getElementById('emailModal')) return;
            const modal = document.getElementById('emailModal');
            modal.classList.remove('active');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
    </script>
</body>
</html>
