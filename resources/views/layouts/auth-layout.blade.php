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
    <div id="loader-bg" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[99999]">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-12 w-12 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <span class="text-white text-lg font-semibold">Cargando...</span>
    </div>
</div>

{{-- <body class="bg-blue-200 h-screen flex flex-col p-0"> --}}


<!-- CONTENIDO -->
<div class="flex-grow p-0">
    @yield('contenido')
</div>

<!-- FOOTER -->
<footer class="text-white text-bold py-4 mt-auto">

</footer>

@yield('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
function mostrarLoader() {
    document.getElementById('loader-bg').style.display = 'flex';
}
function ocultarLoader() {
    document.getElementById('loader-bg').style.display = 'none';
}
window.addEventListener('load', function() {
    ocultarLoader();
});
</script>
</body>
</html>
