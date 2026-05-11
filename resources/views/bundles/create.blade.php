<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Paquete</title>
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
            --danger: #d93d3b;
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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 800px;
        }

        .header {
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            box-sizing: border-box;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: white;
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        .items-section {
            background-color: #fafafc;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
        }

        .items-section h3 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 18px;
        }

        .item-row {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
            background: white;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .item-info {
            flex: 1;
        }

        .remove-btn {
            color: var(--danger);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }

        .add-item-controls {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-secondary {
            background-color: #e5e5ea;
            color: var(--text-color);
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .submit-btn:hover {
            background-color: var(--primary-hover);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Crear Nuevo Paquete</h1>
            <a href="{{ route('bundles.index') }}" style="font-size: 14px; color: var(--primary-color); text-decoration: none;">&larr; Volver a la lista</a>
        </div>

        @if($errors->any())
            <div style="background-color: #fceceb; color: #d93d3b; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-size: 14px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bundles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Nombre del Paquete</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ej. Set de Inicio Guerrero" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Describe qué incluye y por qué es una gran oferta...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Precio Especial ($)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" placeholder="99.99" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="image">Imagen del Paquete</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="items-section">
                <h3>Componentes del Paquete</h3>
                
                <div class="add-item-controls">
                    <select id="item-type" class="form-control" style="width: 150px;">
                        <option value="figure">Figura</option>
                        <option value="paint">Pintura</option>
                    </select>
                    
                    <select id="item-selector" class="form-control">
                        <!-- Populated by JS -->
                    </select>
                    
                    <input type="number" id="item-qty" class="form-control" style="width: 80px;" value="1" min="1">
                    
                    <button type="button" class="btn btn-secondary" onclick="addItem()">Añadir</button>
                </div>

                <div id="items-list">
                    <!-- Items added here -->
                </div>
            </div>

            <button type="submit" class="submit-btn">Crear Paquete Promocional</button>
        </form>
    </div>

    <script>
        const figures = @json($figures);
        const paints = @json($paints);
        
        const typeSelector = document.getElementById('item-type');
        const itemSelector = document.getElementById('item-selector');
        const itemsList = document.getElementById('items-list');
        let itemIndex = 0;

        function updateItemSelector() {
            const type = typeSelector.value;
            const source = type === 'figure' ? figures : paints;
            
            itemSelector.innerHTML = source.map(item => 
                `<option value="${item.id}">${item.name} ($${item.price})</option>`
            ).join('');
        }

        typeSelector.addEventListener('change', updateItemSelector);
        updateItemSelector();

        function addItem() {
            const type = typeSelector.value;
            const itemId = itemSelector.value;
            const itemName = itemSelector.options[itemSelector.selectedIndex].text;
            const qty = document.getElementById('item-qty').value;

            if (!itemId) return;

            const row = document.createElement('div');
            row.className = 'item-row';
            row.id = `item-row-${itemIndex}`;
            row.innerHTML = `
                <div class="item-info">
                    <strong>${itemName}</strong>
                    <span style="color: var(--text-muted); margin-left: 8px;">x ${qty}</span>
                    <input type="hidden" name="items[${itemIndex}][id]" value="${itemId}">
                    <input type="hidden" name="items[${itemIndex}][type]" value="${type}">
                    <input type="hidden" name="items[${itemIndex}][quantity]" value="${qty}">
                </div>
                <button type="button" class="remove-btn" onclick="removeItem(${itemIndex})">Quitar</button>
            `;
            
            itemsList.appendChild(row);
            itemIndex++;
        }

        function removeItem(index) {
            document.getElementById(`item-row-${index}`).remove();
        }
    </script>
</body>
</html>
