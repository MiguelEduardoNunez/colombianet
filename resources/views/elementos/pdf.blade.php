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
        <img src="{{ public_path('logo.png') }}" alt="" style="width: 100%">
    </header>

    <div class="container">

        <div class="textencabezado">
            <h3 class="textend">Fecha: {{ $proyecto->creado_en }}</h3>
            <h1 class="textencabezado"> ELEMENTOS DEL PROYECTO {{$proyecto->proyecto}}</h1>
            <p class="textencabezado">En el presente documento se detallan los elementos del proyecto
                {{ $proyecto->proyecto }}</p>
        </div>

        <div class="datos-proyecto">
            <table class="tabla">
                <thead>
                    <th>Cantidad</th>
                    <th>Proyecto</th>
                    <th>Elemento</th>
                    <th>Marca</th>
                    <th>Serial</th>
                    <th>Codigo de barras</th>
                </thead>
                @foreach ($elementos as $elemento)
                    <tr>
                        <td>{{ $elemento->cantidad }}</td>
                        <td>{{ $elemento->proyecto->proyecto}}</td>
                        <td>{{ $elemento->item->item }}</td>
                        <td>{{ $elemento->marca }}</td>
                        <td>{{ $elemento->serial }}</td>
                        <td><div class="codigo-barras">{{ $elemento->codigo_barras }}</div></td>
                    </tr>
                @endforeach
            </table>
        </div>


    </div>

    <footer class="footer">
        <img src="{{ public_path('footer.png') }}" alt="" style="width: 100%">
    </footer>
</body>

</html>
