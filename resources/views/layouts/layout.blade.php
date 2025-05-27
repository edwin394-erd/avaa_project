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

<body class="bg-gray-100 h-screen flex flex-col p-0" @yield('body-style') >
<div id="loader-bg" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[99999]">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-12 w-12 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <span class="text-white text-lg font-semibold">Cargando...</span>
    </div>
</div>

@php
  $currentRoute = Route::currentRouteName();
@endphp

@guest
<nav class="border-gray-200 bg-slate-800">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-0">
  <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
    <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-14" alt="avaa Logo" />
    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Stats</span>
  </a>
  <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2  text-gray-400 hover:bg-blue-500 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
    </svg>
  </button>
  <div class="hidden w-full md:block md:w-auto" id="navbar-default">
    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-slate-800 border-gray-700">
    <li>
      <a href="{{route('login')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'login' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
      Iniciar Sesión
      </a>
    </li>
    <li>
      <a href="{{route('register')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'register' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
      Registrarse
      </a>
    </li>
    </ul>
  </div>
  </div>
</nav>
@endguest

@auth
<nav class="border-gray-200 bg-slate-800">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto min-h-15 py-2 px-1">
    <div class="flex items-center flex-shrink-0">
      <a href="{{route('home')}}" class="flex items-center space-x-1 rtl:space-x-reverse ms-2">
        <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-24" alt="avaa Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Stats</span>
      </a>
    </div>
    <div class="flex-grow"></div>
    <div class="w-auto flex items-center" id="navbar-default">
    <ul class="font-medium flex flex-row items-center p-0 mt-0 border-0 rounded-lg space-x-4 md:space-x-8 rtl:space-x-reverse bg-slate-800 mr-2 md:mr-0">
        @if(auth()->user()->role == 'admin')
            <li class="flex flex-col items-center">
                <a href="{{route('home')}}"
                    class="flex items-center rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
                    {{ $currentRoute == 'home' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
                    <span class="group flex items-center">
                        <svg class="transition-colors duration-200 group-hover:fill-green-300" fill="#ffffff" width="20" height="20" viewBox="0 0 20 20"><rect width="20" height="20" rx="3"/></svg>
                        <span class="ml-2">Panel Admin</span>
                    </span>
                </a>
            </li>
            <li class="flex flex-col items-center">
                <a href="{{route('home')}}"
                    class="flex items-center rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
                    {{ $currentRoute == 'home' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
                    <span class="group flex items-center">
                        <svg class="transition-colors duration-200 group-hover:fill-green-300" fill="#ffffff" width="20" height="20" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8"/></svg>
                        <span class="ml-2">Ver Estadísticas</span>
                    </span>
                </a>
            </li>
            <li class="flex flex-col items-center">
                <a href="{{route('stats.index')}}"
                    class="flex items-center rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
                    {{ $currentRoute == 'stats.index' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
                    <span class="group flex items-center">
                        <svg class="transition-colors duration-200 group-hover:fill-green-300" fill="#ffffff" width="20" height="20" viewBox="0 0 20 20"><rect x="4" y="4" width="12" height="12"/></svg>
                        <span class="ml-2">Gestionar Usuarios</span>
                    </span>
                </a>
            </li>
        @else
            <li class="flex flex-col items-center">
                <a href="" title="Notificaciones"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                       <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="19px" height="19px" viewBox="0,0,256,256" class="">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,0c-2.20703,0 -4,1.79297 -4,4c0,2.20703 1.79297,4 4,4c2.20703,0 4,-1.79297 4,-4c0,-2.20703 -1.79297,-4 -4,-4zM19.375,6.09375c-4.57031,1.95703 -7.375,6.36328 -7.375,11.90625c0,11 -3.80078,13.76172 -6.0625,15.40625c-1.00391,0.72656 -1.9375,1.40234 -1.9375,2.59375c0,4.20703 6.28125,6 21,6c14.71875,0 21,-1.79297 21,-6c0,-1.19141 -0.93359,-1.86719 -1.9375,-2.59375c-2.26172,-1.64453 -6.0625,-4.40625 -6.0625,-15.40625c0,-5.55859 -2.80078,-9.95312 -7.375,-11.90625c-0.85547,2.27344 -3.05859,3.90625 -5.625,3.90625c-2.56641,0 -4.76953,-1.63672 -5.625,-3.90625zM19,43.875c0,0.03906 0,0.08594 0,0.125c0,3.30859 2.69141,6 6,6c3.30859,0 6,-2.69141 6,-6c0,-0.03906 0,-0.08594 0,-0.125c-1.88281,0.07813 -3.88281,0.125 -6,0.125c-2.11719,0 -4.11719,-0.04687 -6,-0.125z"></path></g></g>
                        </svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'notificaciones.index' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>
            <li class="flex flex-col items-center">
                <a href="{{route('home')}}" title="Inicio"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"></path> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"></path> </g> </g> </g> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'home' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>
            <li class="flex flex-col items-center">
                <a href="{{route('stats.index')}}" title="Gestionar Actividades"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" width="20px" height="20px" viewBox="0 0 16 16" id="table-3-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_29" data-name="Path 29" d="M37.5,0h-11A2.5,2.5,0,0,0,24,2.5v11A2.5,2.5,0,0,0,26.5,16h11A2.5,2.5,0,0,0,40,13.5V2.5A2.5,2.5,0,0,0,37.5,0Zm-11,1h11A1.5,1.5,0,0,1,39,2.5V4H25V2.5A1.5,1.5,0,0,1,26.5,1ZM25,13.5V5h4V15H26.5A1.5,1.5,0,0,1,25,13.5ZM37.5,15H30V5h9v8.5A1.5,1.5,0,0,1,37.5,15ZM26,6.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,0,1h-1A.5.5,0,0,1,26,6.5Zm2,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,9.5Zm0,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,12.5Zm10-6a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,6.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,9.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,12.5Z" transform="translate(-24)"></path> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'stats.index' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>
        @endif
        <!-- Dropdown Perfil -->
        <li class="relative flex flex-col items-center group">
            <button type="button" class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative focus:outline-none" id="perfilDropdownBtn">
                <span class="flex items-center justify-center">
                    <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 45.532 45.532" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765 S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53 c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012 c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592 c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"></path> </g> </g></svg>
                </span>
                <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'configuser.index' || $currentRoute == 'datos.index'? 'bg-green-600' : 'invisible' }}"></span>
            </button>
            <div class="hidden absolute right-0 mt-10 w-48 bg-white rounded-md shadow-lg z-50 transition-all duration-300 origin-top-right scale-95 opacity-0" id="perfilDropdownMenu">
                <a href="{{ route('configuser.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-md">Configuración de usuario</a>
                {{-- <a href="{{ route('datos.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Datos personales</a> --}}
                <button type="button" onclick="openLogoutModal()" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Cerrar Sesión</button>
            </div>

            <!-- Modal de confirmación de cierre de sesión -->
            <div id="logoutModal" class="fixed inset-0 z-[999999] flex items-center justify-center bg-black bg-opacity-40 hidden opacity-0 transition-opacity duration-300">
                <div id="logoutModalContent" class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xs scale-95 opacity-0 transition-all duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 text-center">¿Cerrar sesión?</h3><hr><br>
                    <p class="mb-6 text-gray-600 text-center">¿Estás seguro que deseas cerrar sesión?</p>
                    <div class="flex justify-center space-x-2 mx-auto">
                        <button onclick="closeLogoutModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancelar</button>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded hover:bg-slate-900 rounded-b-md">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                #logoutModal.opacity-100 { opacity: 1 !important; }
                #logoutModalContent.scale-100 { transform: scale(1) !important; opacity: 1 !important; }
            </style>
        </li>
    </ul>
    </div>
  </div>
</nav>
@endauth

<div class="flex-grow p-0">
    @yield('contenido')
</div>



<footer class="py-4 mt-auto bg-slate-900 text-white">
  <div class="container mx-auto text-center">
    <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
  </div>
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
<script>
        // Dropdown toggle for perfil
        document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('perfilDropdownBtn');
        const menu = document.getElementById('perfilDropdownMenu');
        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    setTimeout(() => {
                        menu.classList.remove('scale-95', 'opacity-0');
                        menu.classList.add('scale-100', 'opacity-100');
                    }, 10);
                } else {
                    menu.classList.remove('scale-100', 'opacity-100');
                    menu.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200);
                }
            });
            document.addEventListener('click', function (e) {
                if (!btn.contains(e.target) && !menu.classList.contains('hidden')) {
                    menu.classList.remove('scale-100', 'opacity-100');
                    menu.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200);
                }
            });
        }
    });
    </script>
      <script>
                function openLogoutModal() {
                    const modal = document.getElementById('logoutModal');
                    const content = document.getElementById('logoutModalContent');
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modal.classList.add('opacity-100');
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }
                function closeLogoutModal() {
                    const modal = document.getElementById('logoutModal');
                    const content = document.getElementById('logoutModalContent');
                    modal.classList.remove('opacity-100');
                    modal.classList.add('opacity-0');
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }
            </script>

            <script>
window.createNotification = function({ type = 'success', title = '', message = '' }) {
    const notificationsContainer = document.getElementById('notificationsContainer');
    const notification = document.createElement('div');
    let color = 'text-green-700', icon = `
        <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 13l4 4L19 7" />
        </svg>`;
    if (type === 'error') {
        color = 'text-red-700';
        icon = `<svg fill="#d11f1f" class="w-6 h-6" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#d11f1f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect id="Icons" x="-704" y="-64" width="1280" height="800" style="fill:none;"></rect> <g id="Icons1" serif:id="Icons"> <g id="Strike"> </g> <g id="H1"> </g> <g id="H2"> </g> <g id="H3"> </g> <g id="list-ul"> </g> <g id="hamburger-1"> </g> <g id="hamburger-2"> </g> <g id="list-ol"> </g> <g id="list-task"> </g> <g id="trash"> </g> <g id="vertical-menu"> </g> <g id="horizontal-menu"> </g> <g id="sidebar-2"> </g> <g id="Pen"> </g> <g id="Pen1" serif:id="Pen"> </g> <g id="clock"> </g> <g id="external-link"> </g> <g id="hr"> </g> <g id="info"> </g> <g id="warning"> </g> <path id="error-circle" d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z"></path> <g id="plus-circle"> </g> <g id="minus-circle"> </g> <g id="vue"> </g> <g id="cog"> </g> <g id="logo"> </g> <g id="radio-check"> </g> <g id="eye-slash"> </g> <g id="eye"> </g> <g id="toggle-off"> </g> <g id="shredder"> </g> <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g> <g id="react"> </g> <g id="check-selected"> </g> <g id="turn-off"> </g> <g id="code-block"> </g> <g id="user"> </g> <g id="coffee-bean"> </g> <g id="coffee-beans"> <g id="coffee-bean1" serif:id="coffee-bean"> </g> </g> <g id="coffee-bean-filled"> </g> <g id="coffee-beans-filled"> <g id="coffee-bean2" serif:id="coffee-bean"> </g> </g> <g id="clipboard"> </g> <g id="clipboard-paste"> </g> <g id="clipboard-copy"> </g> <g id="Layer1"> </g> </g> </g></svg>`;
    }
    notification.className = 'w-full max-w-sm md:max-w-md bg-white shadow-md rounded-md p-4 flex items-center space-x-4 border border-gray-300 opacity-0 translate-x-8 pointer-events-none transition-all duration-500 mb-2';
    notification.innerHTML = `
        ${icon}
        <div class="flex-1">
            <p class="${color} font-semibold text-sm">${title}</p>
            <p class="text-gray-600 text-xs">${message}</p>
        </div>
        <button class="closeBtn text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;
    notificationsContainer.insertBefore(notification, notificationsContainer.firstChild);
    setTimeout(() => {
        notification.classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
        notification.classList.add('opacity-100', 'translate-x-0');
    }, 10);
    const closeBtn = notification.querySelector('.closeBtn');
    let hideTimeout = setTimeout(() => removeNotification(notification), 5000);
    closeBtn.addEventListener('click', function() {
        clearTimeout(hideTimeout);
        removeNotification(notification);
    });
    function removeNotification(notification) {
        notification.classList.remove('opacity-100', 'translate-x-0');
        notification.classList.add('opacity-0', 'translate-x-8', 'pointer-events-none');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
};
</script>

{{-- Notificaciones desde el backend --}}
<script>
@if(session('success'))
    window.addEventListener('DOMContentLoaded', function() {
        createNotification({
            type: 'success',
            title: '¡Éxito!',
            message: @json(session('success'))
        });
    });
@endif
@if(session('error'))
    window.addEventListener('DOMContentLoaded', function() {
        createNotification({
            type: 'error',
            title: 'Error',
            message: @json(session('error'))
        });
    });
@endif
</script>
<div id="notificationsContainer" class="fixed top-8 right-4 z-[99999] flex flex-col items-end space-y-2 md:min-w-[900px]"></div>
</body>

</html>
