<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .header {
            margin-bottom: 20px;
        }

        .logo {
            height: 40px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('logo.png') }}" class="logo" alt="Logo">
        <h2>Reporte de Normativas</h2>
        <p>Fecha: {{ date('d/m/Y') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $r)
            <tr>
                <td>{{ $r['nombre'] ?? '' }}</td>
                <td>{{ $r['area'] ?? '' }}</td>
                <td>{{ $r['estado'] ?? '' }}</td>
                <td>{{ $r['responsable'] ?? '' }}</td>
                <td>{{ $r['fecha_emision'] ?? '' }}</td>
                <td>{{ $r['fecha_vencimiento'] ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>