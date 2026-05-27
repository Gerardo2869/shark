<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Cotización</title>
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

        [data-theme="dark"] {
            --bg-color: #000000;
            --text-color: #f5f5f7;
            --text-muted: #a1a1a6;
            --card-bg: #1c1c1e;
            --border-color: #38383a;
            --input-bg: #2c2c2e;
            --primary-color: #0a84ff;
            --primary-hover: #409cff;
        }

        .theme-toggle-admin {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .theme-toggle-admin:hover {
            background-color: rgba(128, 128, 128, 0.1);
        }


        body {
            transition: background-color 0.5s ease, color 0.5s ease;
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
            box-sizing: border-box;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
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

        .footer {
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-amount {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-color);
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
        }

        /* Custom Select */
        .custom-select-container {
            position: relative;
        }

        .custom-select-trigger {
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            cursor: pointer;
            min-height: 46px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-select-container.disabled {
            opacity: 0.6;
            cursor: not-allowed;
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
            max-height: 250px;
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
        }

        .custom-option:hover {
            background-color: #f5f5f7;
        }

        .option-thumb {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f0f0f2;
        }

        .info-badge {
            background-color: #eef7ff;
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Nueva Cotización</h1>
            <button type="button" class="theme-toggle-admin" onclick="window.toggleTheme()" aria-label="Cambiar tema">
                <svg id="sunIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
                <svg id="moonIcon" style="display:none;" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>

            <a href="{{ route('quotes.index') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                Regresar
            </a>
        </div>

        <form action="{{ route('quotes.store') }}" method="POST" id="quoteForm">
            @csrf

            <div class="form-group">
                <label for="client_name">Nombre del Cliente (Opcional)</label>
                <input type="text" name="client_name" id="client_name" class="input-field" placeholder="Ej. Juan Pérez">
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <span class="info-badge">Duración: 30 días</span>
                <span style="font-size: 12px; color: var(--text-muted);">Válida hasta:
                    {{ now()->addDays(30)->format('d/m/Y') }}</span>
            </div>

            <div class="items-container" id="itemsContainer">
                <div
                    style="display: grid; grid-template-columns: 120px 1fr 100px 100px 40px; gap: 12px; margin-bottom: 12px; padding: 0 16px; font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">
                    <div>Tipo</div>
                    <div>Artículo</div>
                    <div>Cant.</div>
                    <div style="text-align: right;">Subtotal</div>
                    <div></div>
                </div>
            </div>

            <button type="button" class="add-line-btn" id="addLineBtn">+ Agregar artículo</button>

            <div class="footer">
                <div class="total-display">
                    <div style="font-size: 14px; color: var(--text-muted);">Total Cotizado</div>
                    <div class="total-amount" id="grandTotal">$0.00</div>
                </div>
                <button type="submit" class="submit-btn">Crear Cotización</button>
            </div>
        </form>
    </div>

    <script>
        const inventory = {
            paint: @json($paints),
            figure: @json($figures)
        };
        const storageUrl = "{{ asset('storage') }}/";

        const container = document.getElementById('itemsContainer');
        const addBtn = document.getElementById('addLineBtn');
        const grandTotalDisplay = document.getElementById('grandTotal');
        let rowCount = 0;

        function createRow() {
            const index = rowCount++;
            const row = document.createElement('div');
            row.className = 'item-row';
            row.innerHTML = `
                <div>
                    <select name="items[${index}][type]" class="input-field type-select" required>
                        <option value="" disabled selected>Tipo...</option>
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
                </div>
                <div>
                    <input type="number" name="items[${index}][quantity]" class="input-field quantity-input" min="1" value="1" required disabled>
                </div>
                <div style="text-align: right; font-weight: 600; padding-bottom: 12px;" class="subtotal-display">$0.00</div>
                <div>
                    <button type="button" class="remove-btn" onclick="this.closest('.item-row').remove(); updateGrandTotal();">
                        &times;
                    </button>
                </div>
            `;

            container.appendChild(row);

            const typeSelect = row.querySelector('.type-select');
            const qtyInput = row.querySelector('.quantity-input');
            const customSelect = row.querySelector('.custom-select-container');
            const trigger = row.querySelector('.custom-select-trigger');
            const optionsDiv = row.querySelector('.custom-options');
            const hiddenInput = row.querySelector('.item-id-input');

            trigger.onclick = () => {
                if (!customSelect.classList.contains('disabled')) {
                    customSelect.classList.toggle('open');
                }
            };

            typeSelect.onchange = () => {
                const type = typeSelect.value;
                qtyInput.disabled = !type;
                customSelect.classList.remove('disabled');
                trigger.textContent = 'Seleccionar...';
                hiddenInput.value = '';

                optionsDiv.innerHTML = '';
                inventory[type].forEach(item => {
                    const opt = document.createElement('div');
                    opt.className = 'custom-option';

                    let thumb = '';
                    if (type === 'figure' && item.image) {
                        thumb = `<img src="${storageUrl + item.image}" class="option-thumb">`;
                    } else if (type === 'paint' && item.hex_color) {
                        thumb = `<div class="option-thumb" style="background: ${item.hex_color}"></div>`;
                    }

                    opt.innerHTML = `${thumb} <div><div style="font-size: 14px;">${item.name}</div><div style="font-size: 11px; color: var(--text-muted);">$${parseFloat(item.price).toFixed(2)}</div></div>`;

                    opt.onclick = () => {
                        hiddenInput.value = item.id;
                        trigger.textContent = item.name;
                        customSelect.classList.remove('open');
                        updateGrandTotal();
                    };
                    optionsDiv.appendChild(opt);
                });
            };

            qtyInput.oninput = updateGrandTotal;
        }

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const type = row.querySelector('.type-select').value;
                const id = row.querySelector('.item-id-input').value;
                const qty = parseInt(row.querySelector('.quantity-input').value) || 0;
                const subtotalDisplay = row.querySelector('.subtotal-display');

                if (type && id) {
                    const item = inventory[type].find(i => i.id == id);
                    if (item) {
                        const sub = item.price * qty;
                        total += sub;
                        subtotalDisplay.textContent = `$${sub.toFixed(2)}`;
                    }
                }
            });
            grandTotalDisplay.textContent = `$${total.toLocaleString('en-US', { minimumFractionDigits: 2 })}`;
        }

        addBtn.onclick = createRow;
        createRow();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const htmlElement = document.documentElement;
            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            
            function setTheme(theme) {
                htmlElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                
                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');
                
                if (sunIcon && moonIcon) {
                    if (theme === 'dark') {
                        sunIcon.style.display = 'none';
                        moonIcon.style.display = 'block';
                    } else {
                        sunIcon.style.display = 'block';
                        moonIcon.style.display = 'none';
                    }
                }
            }
            
            setTheme(savedTheme);
            
            // Allow toggle clicks from a button
            window.toggleTheme = function() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            };
        });
    </script>

</body>

</html>