<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Header</title>
</head>
<style>
    #header {
        position: fixed;
        top: 0cm;
        left: 0cm;
    }
</style>

<body>
    <div id="header">
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
                    <p class="d-inline">{{ $reunion->gerencia }}</p>
                </td>
                <td>
                    <p class="d-inline font-weight-bold">FECHA:</p>
                    <p class="d-inline">{{ $formatDate }}</p>
                </td>
                <td>
                    <p class="d-inline font-weight-bold">REGISTRO No.</p>
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
    </div>
</body>

</html>
