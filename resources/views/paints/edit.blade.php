<!DOCTYPE html>
<html lang="es">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pintura</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background-color: var(--card-bg);
            border-radius: 18px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 18px;
            background-color: var(--input-bg);
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.2s ease;
            position: absolute;
            top: 24px;
            left: 24px;
        }

        .back-button:hover {
            background-color: var(--border-color);
        }

        .back-button svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.015em;
        }

        .header p {
            margin: 8px 0 0;
            color: var(--text-muted);
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            margin-bottom: 0;
            flex: 1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        input,
        select {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            font-family: inherit;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background-color: var(--input-bg);
            color: var(--text-color);
            transition: all 0.2s ease;
            box-sizing: border-box;
            appearance: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2386868b' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--card-bg);
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        input::placeholder {
            color: var(--text-muted);
        }

        button {
            width: 100%;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 12px;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="/paints" class="back-button" title="Volver al inventario">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
        </a>

        <div class="header">
            <h1>Editar Pintura</h1>
            <p>Modifica los detalles de la pintura en el inventario.</p>
        </div>

        <form method="POST" action="/paints/{{ $paint->id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" value="{{ $paint->name }}" placeholder="Ej. Macragge Blue" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="brand">Marca</label>
                    <input id="brand" name="brand" type="text" value="{{ $paint->brand }}" placeholder="Ej. Citadel" required>
                </div>

                <div class="form-group">
                    <label for="color_type">Tipo de Color</label>
                    <select id="color_type" name="color_type" required>
                        <option value="base" {{ $paint->color_type == 'base' ? 'selected' : '' }}>Base</option>
                        <option value="layer" {{ $paint->color_type == 'layer' ? 'selected' : '' }}>Layer</option>
                        <option value="shade" {{ $paint->color_type == 'shade' ? 'selected' : '' }}>Shade</option>
                        <option value="dry" {{ $paint->color_type == 'dry' ? 'selected' : '' }}>Dry</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input id="stock" name="stock" type="number" value="{{ $paint->stock }}" placeholder="0" min="0" required>
                </div>

                <div class="form-group">
                    <label for="price">Precio ($)</label>
                    <input id="price" name="price" type="number" step="0.01" value="{{ $paint->price }}" placeholder="0.00" min="0" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="expiration_date">Fecha de Caducidad</label>
                    <input id="expiration_date" name="expiration_date" type="date" value="{{ $paint->expiration_date }}">
                </div>

                <div class="form-group">
                    <label for="ml">Volumen (ML)</label>
                    <input id="ml" name="ml" type="number" value="{{ $paint->ml }}" placeholder="Ej. 12" min="1" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="finish">Acabado</label>
                    <input id="finish" name="finish" type="text" value="{{ $paint->finish }}" placeholder="Ej. Mate, Brillante">
                </div>

                <div class="form-group">
                    <label for="code">Código</label>
                    <input id="code" name="code" type="text" value="{{ $paint->code }}" placeholder="Ej. 21-02">
                </div>
            </div>

            <div class="form-group">
                <label for="is_active">Estado</label>
                <select id="is_active" name="is_active" required>
                    <option value="1" {{ $paint->is_active ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$paint->is_active ? 'selected' : '' }}>Descontinuado</option>
                </select>
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>

</body>

</html>