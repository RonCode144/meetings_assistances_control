<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ base_path('public/css/pdf.css') }}"> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <title>Portal de Reuniones - Lista de Asistentes</title>
    <style>
        /* @page{
            margin: 0cm, 0.5cm;
        } */
        body {
            box-sizing: border-box;
            font-family: sans-serif;
        }

        #header {
            position: fixed;
            top: 0cm;
            left: 0cm;
        }

        #tr_gerencia {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 30px;
        }

        #bg-asistants-list {
            background-color: #D3D3D3;
        }

        .realizo {
            padding-bottom: 20px;
        }

        .coordino {
            padding-bottom: 20px;
        }

        .div-1 {
            position: absolute;
            width: 290px;
            padding: 3px;
            margin-right: 100x;
            left: 50px;
        }

        .div-2 {
            position: absolute;
            width: 290px;
            padding: 3px;
            margin-left: 100px;
            right: 50px;
        }
    </style>
</head>

<body>
    <table class="table table-sm table-bordered">
        <thead>
            <tr style="position: absolute">
                <th>
                    <img src="{{ public_path() . $image }}" class="d-inline" alt="Cotecmar-Logo" width="75"
                        height="75">
                </th>
            </tr>
            <tr>
                <th colspan="3" class="text-center font-weight-bold">CONTROL DE ASISTENCIA</th>
            </tr>
            <tr>
                <td class="text-center" style="font-size: 10px;">Código: F-GEN-009</td>
                <td class="text-center" style="font-size: 10px;">Versión: 5</td>
                <td class="text-center" style="font-size: 10px;">Fecha de Aprobación: 02-Jul-2014</td>
            </tr>
        </thead>
    </table>

    <table class="table table-sm table-bordered">
        <tr>
            <td>
                <p class="d-inline font-weight-bold">GERENCIA:</p>
                <p class="d-inline">{{ $validateGerenciaData }}</p>
                {{-- <p>{{ dd($reunion) }}</p> --}}
            </td>
            <td>
                <p class="d-inline font-weight-bold">FECHA:</p>
                <p class="d-inline">{{ $formatDate }}</p>
            </td>
            <td>
                <p class="d-inline font-weight-bold">REGISTRO No.</p>
                <p class="d-inline">{{ $reunion->id }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="d-inline font-weight-bold">TEMA:</p>
                <p class="d-inline">{{ $reunion->tema }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="d-inline font-weight-bold">INSTRUCTOR:</p>
                <p class="d-inline">{{ $reunion->instructor }}</p>
            </td>
            <td>
                <p class="d-inline font-weight-bold">EMPRESA:</p>
                <p class="d-inline ">{{ $reunion->empresa }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="d-inline font-weight-bold">LUGAR:</p>
                <p class="d-inline ">{{ $reunion->lugar }}</p>
            </td>
            <td>
                <p class="d-inline font-weight-bold">RESPONSABLE:</p>
                <p class="d-inline ">{{ $reunion->responsable }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="d-inline font-weight-bold">HORA DE INICIO:</p>
                <p class="d-inline ">{{ substr($reunion->fechaInicio, -12, -7) }}</p>
            </td>
            <td>
                <p class="d-inline font-weight-bold">HORA DE FINALIZACIÓN:</p>
                <p class="d-inline ">{{ substr($reunion->fechaFinal, -12, -7) }}</p>
            </td>
        </tr>
    </table>

    <table class="table table-bordered pb-5 mb-5">
        <thead>
            <tr>
                <th colspan="6" id="bg-asistants-list" class="text-center">LISTA DE ASISTENTES</th>
            </tr>
            <tr>
                <th id="bg-asistants-list" scope="col">No.</th>
                <th id="bg-asistants-list" scope="col">NOMBRE</th>
                <th id="bg-asistants-list" scope="col">CÉDULA</th>
                <th id="bg-asistants-list" scope="col">CARGO</th>
                <th id="bg-asistants-list" scope="col">GERENCIA</th>
                <th id="bg-asistants-list" scope="col">FIRMA</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reunion->asistentes as $index => $asistente)
                <tr style="font-size: 14px;">
                    <th>{{ $index + 1 }}</th>
                    <td>{{ $asistente->name }}</td>
                    <td>{{ $asistente->identificacion }}</td>
                    <td>{{ $asistente->cargo }}</td>
                    <td>{{ $asistente->gerencia }}</td>
                    <td style="padding: 0px; align-items: center;">
                        <img src="{{ $asistente->firma }}" alt="firma" width="100" height="30">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="firmas">
        <div class="div-1">
            <p class="realizo font-weight-bold">Realizó:</p>
            <span class="font-weight-bold">___________________________</span>
            <p class="font-weight-bold">FIRMA CONFERENCISTA</p>
            <p class="font-weight-bold">C.C._________________</p>
        </div>
        <div class="div-2">
            <p class="coordino font-weight-bold">Coordinó:</p>
            <span class="font-weight-bold">___________________________</span>
            <p class="font-weight-bold">FIRMA COORDINADOR</p>
            <p class="font-weight-bold">C.C.________________</p>
        </div>
    </div>
</body>

</html>
