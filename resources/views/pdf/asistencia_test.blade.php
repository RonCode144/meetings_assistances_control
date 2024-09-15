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

        #tr_gerencia {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 30px;
        }

        #bg-asistants-list {
            background-color: #D3D3D3;
        }

        .container{
            margin-top: 350px;
            width: 100%;
        }
        .hijo {
            width: 2cm;
            height: 1cm;
            margin: 0.2cm;
            background-color: yellow;
        }
    </style>
</head>

<body>
    @include('partials.header')

    <div class="container">
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
    </div>

    <div class="fake-container">
        @for ($i=0; $i < 30; $i++)
            <div class="hijo">
                {{ $i }}
            </div>
        @endfor
    </div>

    @include('partials.footer')
</body>

</html>
