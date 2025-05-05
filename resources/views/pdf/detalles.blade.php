<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Detalles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 22px;
            border-bottom: 2px solid #555;
            padding-bottom: 5px;
        }

        h2 {
            margin-top: 30px;
            font-size: 18px;
            color: #222;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Reporte de Detalles de Ventas y Compras</h1>

    <h2>Detalles de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Venta</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario (Bs.)</th>
                <th>Subtotal (Bs.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallesVentas as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>{{ $detalle->id_venta }}</td>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td class="right">{{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                    <td class="right">{{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Detalles de Compras</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Compra</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario (Bs.)</th>
                <th>Subtotal (Bs.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallesCompras as $detalle)
                <tr>
                    <td>{{ $detalle->id_detalle }}</td>
                    <td>{{ $detalle->id_compra }}</td>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td class="right">{{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
                    <td class="right">{{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
