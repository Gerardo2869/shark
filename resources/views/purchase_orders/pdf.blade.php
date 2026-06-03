<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra - {{ $supplierName }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0071e3;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #0071e3;
            font-size: 32px;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }

        .info-section {
            margin-bottom: 40px;
        }

        .info-section h2 {
            font-size: 18px;
            margin: 0 0 10px 0;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-section p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
            color: #444;
        }

        tr:nth-child(even) td {
            background-color: #fafafa;
        }

        .stock-critico {
            color: #d9534f;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SHARK INVENTORY</h1>
        <p>Reporte de Reabastecimiento Crítico</p>
    </div>

    <div class="info-section">
        <h2>Orden de Compra Para:</h2>
        <p><strong>Proveedor:</strong> {{ $supplierName }}</p>
        <p><strong>Fecha de Emisión:</strong> {{ date('d/m/Y') }}</p>
    </div>

    <table>
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
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['type'] }}</td>
                <td style="text-align: right;" class="stock-critico">{{ $item['stock'] }} un.</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Este documento es generado automáticamente por Shark Inventory.</p>
        <p>Por favor, procesar esta solicitud a la brevedad posible para evitar desabastecimiento.</p>
    </div>

</body>
</html>
