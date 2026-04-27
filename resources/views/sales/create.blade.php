<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
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
            --danger-color: #d93d3b;
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
            max-width: 900px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
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

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .input-field {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .items-container {
            margin-top: 32px;
        }

        .item-row {
            display: grid;
            grid-template-columns: 120px 1fr 100px 100px 40px;
            gap: 12px;
            align-items: end;
            margin-bottom: 16px;
            padding: 16px;
            background-color: #fafafc;
            border-radius: 14px;
            border: 1px solid #f0f0f2;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .remove-btn:hover {
            background-color: #fceceb;
        }

        .add-line-btn {
            background-color: var(--bg-color);
            border: 1px dashed var(--border-color);
            color: var(--primary-color);
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
        }

        .add-line-btn:hover {
            background-color: #f0f0f2;
            border-style: solid;
        }

        .footer {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-display {
            text-align: right;
        }

        .total-label {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .total-amount {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
            letter-spacing: -0.02em;
        }

        .submit-btn {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .stock-info {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .stock-warning {
            color: var(--danger-color);
            font-weight: 600;
        }

        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2386868b' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        /* Custom Select Styles */
        .custom-select-container {
            position: relative;
            width: 100%;
        }

        .custom-select-trigger {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            transition: all 0.2s ease;
            min-height: 46px;
        }

        .custom-select-container.disabled .custom-select-trigger {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #f0f0f2;
        }

        .custom-select-trigger:after {
            content: "";
            width: 12px;
            height: 12px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2386868b' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            transition: transform 0.2s;
        }

        .custom-select-container.open .custom-select-trigger {
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .custom-select-container.open .custom-select-trigger:after {
            transform: rotate(180deg);
        }

        .custom-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-top: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            padding: 8px;
        }

        .custom-select-container.open .custom-options {
            display: block;
        }

        .custom-option {
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background 0.2s;
        }

        .custom-option:hover {
            background-color: #f5f5f7;
        }

        .custom-option.selected {
            background-color: #eef7ff;
            color: var(--primary-color);
        }

        .option-thumb {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f0f0f2;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .option-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .option-name {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .option-price {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Hover Preview */
        #hoverPreview {
            position: fixed;
            z-index: 2000;
            pointer-events: none;
            display: none;
            width: 250px;
            height: 250px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: previewFadeIn 0.2s ease;
        }

        @keyframes previewFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        #hoverPreview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Registrar Nueva Venta</h1>
            <a href="{{ route('sales.index') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                Cancelar
            </a>
        </div>

        @if($errors->any())
            <div
                style="background-color: #fceceb; border: 1px solid #fecaca; border-radius: 12px; padding: 16px 20px; margin-bottom: 24px; color: #b91c1c; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
            @csrf

            <div class="items-container" id="itemsContainer">
                <div
                    style="display: grid; grid-template-columns: 120px 1fr 100px 100px 40px; gap: 12px; margin-bottom: 12px; padding: 0 16px;">
                    <div
                        style="font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">
                        Tipo</div>
                    <div
                        style="font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">
                        Artículo</div>
                    <div
                        style="font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">
                        Cant.</div>
                    <div
                        style="font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; text-align: right;">
                        Subtotal</div>
                    <div></div>
                </div>

                <!-- Items will be added here -->
            </div>

            <button type="button" class="add-line-btn" id="addLineBtn">
                + Agregar artículo
            </button>

            <div class="footer">
                <div class="total-display">
                    <div class="total-label">Total a pagar</div>
                    <div class="total-amount" id="grandTotal">$0.00</div>
                </div>
                <button type="submit" class="submit-btn" id="submitBtn">Finalizar Venta</button>
            </div>
        </form>
    </div>

    <div id="hoverPreview"></div>

    <script>
        const inventory = {
            paint: @json($paints),
            figure: @json($figures)
        };

        const storageUrl = "{{ asset('storage') }}/";
        const hoverPreview = document.getElementById('hoverPreview');

        // Global mouse movement for the hover preview
        document.addEventListener('mousemove', (e) => {
            if (hoverPreview.style.display === 'block') {
                const x = e.clientX + 20;
                const y = e.clientY - 125;

                // Keep within viewport
                const maxX = window.innerWidth - hoverPreview.offsetWidth - 20;
                const maxY = window.innerHeight - hoverPreview.offsetHeight - 20;

                hoverPreview.style.left = Math.min(x, maxX) + 'px';
                hoverPreview.style.top = Math.max(20, Math.min(y, maxY)) + 'px';
            }
        });

        const container = document.getElementById('itemsContainer');
        const addBtn = document.getElementById('addLineBtn');
        const grandTotalDisplay = document.getElementById('grandTotal');
        const form = document.getElementById('saleForm');
        let rowCount = 0;

        function createRow() {
            const index = rowCount++;
            const row = document.createElement('div');
            row.className = 'item-row';
            row.dataset.index = index;

            row.innerHTML = `
                <div>
                    <select name="items[${index}][type]" class="input-field type-select" required>
                        <option value="" disabled selected>Elegir...</option>
                        <option value="paint">Pintura</option>
                        <option value="figure">Figura</option>
                    </select>
                </div>
                <div class="item-select-col">
                    <div class="custom-select-container disabled" id="custom-select-${index}">
                        <div class="custom-select-trigger">Primero elije tipo...</div>
                        <div class="custom-options"></div>
                        <input type="hidden" name="items[${index}][id]" class="item-id-input" required>
                    </div>
                    <div class="stock-info" id="stock-${index}"></div>
                </div>
                <div>
                    <input type="number" name="items[${index}][quantity]" class="input-field quantity-input" min="1" value="1" required disabled>
                </div>
                <div style="text-align: right; font-weight: 600; padding-bottom: 12px;" class="subtotal-display" id="subtotal-${index}">
                    $0.00
                </div>
                <div>
                    <button type="button" class="remove-btn" onclick="this.closest('.item-row').remove(); updateGrandTotal();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </div>
            `;

            container.appendChild(row);

            initCustomSelect(row);

            const typeSelect = row.querySelector('.type-select');
            const qtyInput = row.querySelector('.quantity-input');

            typeSelect.addEventListener('change', () => {
                const type = typeSelect.value;
                resetCustomSelect(row, type);
                qtyInput.disabled = !type;
                updateRow(row);
            });

            qtyInput.addEventListener('input', () => updateRow(row));
        }

        function initCustomSelect(row) {
            const index = row.dataset.index;
            const container = document.getElementById(`custom-select-${index}`);
            const trigger = container.querySelector('.custom-select-trigger');
            const options = container.querySelector('.custom-options');
            const hiddenInput = container.querySelector('.item-id-input');

            trigger.addEventListener('click', (e) => {
                if (container.classList.contains('disabled')) return;

                // Close all other selects
                document.querySelectorAll('.custom-select-container').forEach(c => {
                    if (c !== container) c.classList.remove('open');
                });

                container.classList.toggle('open');
                e.stopPropagation();
            });

            document.addEventListener('click', () => {
                container.classList.remove('open');
            });
        }

        function resetCustomSelect(row, type) {
            const index = row.dataset.index;
            const container = document.getElementById(`custom-select-${index}`);
            const trigger = container.querySelector('.custom-select-trigger');
            const optionsDiv = container.querySelector('.custom-options');
            const hiddenInput = container.querySelector('.item-id-input');

            hiddenInput.value = '';

            if (!type || !inventory[type] || inventory[type].length === 0) {
                container.classList.add('disabled');
                trigger.textContent = type && inventory[type].length === 0 ? 'Sin stock' : 'Primero elije tipo...';
                optionsDiv.innerHTML = '';
                return;
            }

            container.classList.remove('disabled');
            trigger.textContent = 'Seleccionar artículo...';

            optionsDiv.innerHTML = '';
            inventory[type].forEach(item => {
                const option = document.createElement('div');
                option.className = 'custom-option';

                const price = parseFloat(item.price) || 0;

                let thumbHtml = '';
                if (type === 'figure' && item.image) {
                    thumbHtml = `<img src="${storageUrl + item.image}" class="option-thumb" alt="">`;
                } else if (type === 'paint') {
                    // Placeholder for paint or actual color
                    if (item.hex_color) {
                        thumbHtml = `<div class="option-thumb" style="background: ${item.hex_color}; border: 1px solid rgba(0,0,0,0.1);"></div>`;
                    } else {
                        thumbHtml = `<div class="option-thumb" style="background: var(--primary-color); opacity: 0.1;"></div>`;
                    }
                }

                option.innerHTML = `
                    ${thumbHtml}
                    <div class="option-info">
                        <span class="option-name">${item.name}</span>
                        <span class="option-price">$${price.toFixed(2)}</span>
                    </div>
                `;

                option.addEventListener('click', (e) => {
                    hiddenInput.value = item.id;
                    trigger.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 10px;">
                            ${thumbHtml}
                            <div style="display: flex; flex-direction: column;">
                                <span style="font-size: 14px; font-weight: 500;">${item.name}</span>
                                <span style="font-size: 11px; color: var(--text-muted);">$${price.toFixed(2)}</span>
                            </div>
                        </div>
                    `;
                    container.classList.remove('open');

                    // Mark as selected
                    optionsDiv.querySelectorAll('.custom-option').forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');

                    updateRow(row);
                    e.stopPropagation();
                });

                // Hover preview logic
                if (type === 'figure' && item.image) {
                    option.addEventListener('mouseenter', () => {
                        hoverPreview.innerHTML = `<img src="${storageUrl + item.image}" alt="">`;
                        hoverPreview.style.display = 'block';
                    });
                    option.addEventListener('mouseleave', () => {
                        hoverPreview.style.display = 'none';
                    });
                }

                optionsDiv.appendChild(option);
            });
        }

        function updateRow(row) {
            const index = row.dataset.index;
            const type = row.querySelector('.type-select').value;
            const id = row.querySelector('.item-id-input').value;
            const qty = parseInt(row.querySelector('.quantity-input').value) || 0;
            const stockDisplay = document.getElementById(`stock-${index}`);
            const subtotalDisplay = document.getElementById(`subtotal-${index}`);

            if (type && id) {
                const item = inventory[type].find(i => i.id == id);
                if (item) {
                    const price = parseFloat(item.price) || 0;
                    const subtotal = price * qty;
                    subtotalDisplay.textContent = `$${subtotal.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;

                    stockDisplay.innerHTML = `Stock disponible: <span class="${qty > item.stock ? 'stock-warning' : ''}">${item.stock}</span>`;

                    if (qty > item.stock) {
                        row.querySelector('.quantity-input').style.borderColor = 'var(--danger-color)';
                    } else {
                        row.querySelector('.quantity-input').style.borderColor = 'var(--border-color)';
                    }
                }
            } else {
                subtotalDisplay.textContent = '$0.00';
                stockDisplay.textContent = '';
            }
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const type = row.querySelector('.type-select').value;
                const id = row.querySelector('.item-id-input').value;
                const qty = parseInt(row.querySelector('.quantity-input').value) || 0;

                if (type && id) {
                    const item = inventory[type].find(i => i.id == id);
                    if (item) {
                        const price = parseFloat(item.price) || 0;
                        total += price * qty;
                    }
                }
            });
            grandTotalDisplay.textContent = `$${total.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }

        addBtn.addEventListener('click', createRow);

        // Add first row by default
        createRow();

        form.addEventListener('submit', (e) => {
            let hasError = false;
            let errorMessage = '';

            const rows = document.querySelectorAll('.item-row');
            if (rows.length === 0) {
                hasError = true;
                errorMessage = 'Debe agregar al menos un artículo.';
            }

            rows.forEach(row => {
                const type = row.querySelector('.type-select').value;
                const id = row.querySelector('.item-id-input').value;
                const qty = parseInt(row.querySelector('.quantity-input').value) || 0;

                if (type && id) {
                    const item = inventory[type].find(i => i.id == id);
                    if (item && qty > item.stock) {
                        hasError = true;
                        errorMessage = `Stock insuficiente para ${item.name}.`;
                    }
                }
            });

            if (hasError) {
                e.preventDefault();
                alert(errorMessage);
            }
        });
    </script>
</body>

</html>