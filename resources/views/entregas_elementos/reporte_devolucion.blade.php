<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Proyecto</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .textend {
            text-align: right;
            font-size: 15px;
        }

        .textencabezado {
            text-align: center;
            font-size: 20px;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla,
        .tabla th,
        .tabla td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .bordestabla th {
            background-color: #f2f2f2;
        }

        .header {
            width: 100%;
            height: 10vh;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .footer {
            width: 100%;
            height: 10vh;
            position: absolute;
            opacity: 0.5;
            bottom: 0;
        }

        .fondoContainer {
            background-image: url("{{ public_path('marcadeagua.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
        }
    </style>
</head>

<body class="fondoContainer">
    <header class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo" style="width: 100%">
    </header>

    <div class="container">
        <div class="textencabezado">
            <h3 class="textend">Fecha: {{ $proyecto->creado_en }}</h3>
            <h1 class="textencabezado">ACTA DEVOLUCION DE EQUIPOS</h1>
            <p class="textencabezado">Con la presente acta se le hace entrega de los siguientes elementos al proyecto {{ $proyecto->proyecto }}</p>
        </div>

        <div class="datos-proyecto">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Elemento</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo de Cantidad</th>
                        <th>Cantidad Devuelta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle_entrega_elementos as $detalle_entrega_elemento)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detalle_entrega_elemento->elemento->item->item }}</td>
                        <td>{{ $detalle_entrega_elemento->elemento->marca }}</td>
                        <td>{{ $detalle_entrega_elemento->elemento->modelo }}</td>
                        <td>{{ $detalle_entrega_elemento->elemento->tipoCantidad->tipo_cantidad }}</td>
                        <td>{{ $detalle_entrega_elemento->cantidad_devolucionada ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p>Manifiesto que:</p>
            <ul>
                <li>He recibido los equipos de la devolución en buen estado.</li>
            </ul>
        </div>

        <div>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Entregado por:</th>
                        <th>Cargo:</th>
                        <th>Recibido por:</th>
                        <th>Cargo:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $entrega_elemento->empleado->nombres_completos }}</td>
                        <td>Técnico</td>
                        <td>Leidy Viviana Bolaños</td>
                        <td>Almacén</td>
                    </tr>
                    <tr>
                        <th>Firma:</th>
                        <th>Cédula:</th>
                        <th>Firma:</th>
                        <th>Cédula:</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $entrega_elemento->empleado->documento }}</td>
                        <td></td>
                        <td>1061720521</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <img src="{{ public_path('footer.png') }}" alt="Footer" style="width: 100%">
    </footer>
</body>

</html>
