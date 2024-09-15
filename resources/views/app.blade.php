<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Control de Asistencias', 'Registro Personas') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />


    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @csrf
    @inertia
    {{-- <div class="max-w-2xl px-8 py-6 mx-auto my-8 bg-white border rounded-lg shadow-md">
                    <h2>Escanea el código Qr para ser redireccionado al registro individual de asistencia</h2>
                </div>
                <div class="max-w-2xl px-8 py-6 mx-auto my-8 bg-white border rounded-lg shadow-md">
                        <a href="{{route('asistencia')}}">{!! QrCode::size(200)->generate('carde') !!}</a>
                </div> --}}
</body>

</html>
