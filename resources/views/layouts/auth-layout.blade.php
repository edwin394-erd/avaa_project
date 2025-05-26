<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>@yield('titulo-tab')</title>
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('icono.png') }}" type="image/png" />


</head>

<body class="bg-blue-100 h-screen max-h-screen flex flex-col p-0" @yield('body-style') >
{{-- <body class="bg-blue-200 h-screen flex flex-col p-0"> --}}


<!-- CONTENIDO -->
<div class="flex-grow p-0">
    @yield('contenido')
</div>

<!-- FOOTER -->
<footer class="text-white text-bold py-4 mt-auto">

</footer>

@yield('scripts')
<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
