<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Paquetes</title>
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
        <p>Catálogo de Paquetes</p>
        <p>Generado el {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Items (Cantidad)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bundles as $bundle)
            <tr>
                <td>{{ $bundle->id }}</td>
                <td>{{ $bundle->name }}</td>
                <td>${{ number_format($bundle->price, 2) }}</td>
                <td>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($bundle->items as $item)
                        <li>{{ $item->sellable ? $item->sellable->name : 'N/A' }} (x{{ $item->quantity }})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Este documento es generado automáticamente por Shark Inventory.</p>
    </div>

</body>
</html>
