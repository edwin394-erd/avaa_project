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
{{-- <body class="bg-blue-200 h-screen flex flex-col p-0"> --}}



<!-- NAV BAR -->

@php
  // Detecta la ruta actual para marcar el enlace activo
  $currentRoute = Route::currentRouteName();
@endphp

@guest
<nav class="border-gray-200 bg-[#04845c]">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-0">
  <a href="" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
    <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-14" alt="avaa Logo" />
    <span class="self-center text-2xl font-semibold whitespace-nowraptext-white text-white">Stats</span>
  </a>
  <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2  text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
    </svg>
  </button>
  <div class="hidden w-full md:block md:w-auto" id="navbar-default">
    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border  rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  md:bg-[#04845c] border-gray-700">
    <li>
      <a href="{{route('login')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'login' ? 'underline text-green-100 font-bold' : 'md:hover:text-blue-500' }}">
      Iniciar Sesión
      </a>
    </li>
    <li>
      <a href="{{route('register')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'register' ? 'underline text-green-100 font-bold' : 'md:hover:text-blue-500' }}">
      Registrarse
      </a>
    </li>
    </ul>
  </div>
  </div>
</nav>
@endguest

@auth
<nav class="border-gray-200 bg-[#04845c]">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto min-h-15 py-2 px-2">
    <div class="flex items-center flex-shrink-0">
      <a href="" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
        <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-20" alt="avaa Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Stats</span>
      </a>
    </div>
    <div class="flex-grow"></div>
    <div class="w-auto flex items-center" id="navbar-default">
      <ul class="font-medium flex flex-row items-center p-0 mt-0 border-0 rounded-lg space-x-4 md:space-x-8 rtl:space-x-reverse bg-[#04845c]">
        <!-- Navbar para usuarios admin -->
        @if(auth()->user()->role == 'admin')
          <li>
            <a href="{{route('home')}}"
              class="flex items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent
              {{ $currentRoute == 'home' ? 'underline text-green-100 font-bold' : 'md:hover:text-blue-500' }}">
              Panel Admin
            </a>
          </li>
          <li>
            <a href="{{route('home')}}"
              class="flex items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent
              {{ $currentRoute == 'home' ? 'underline text-green-100 font-bold' : 'md:hover:text-blue-500' }}">
              Ver Estadísticas
            </a>
          </li>
          <li>
            <a href="{{route('stats.index')}}"
              class="flex items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent
              {{ $currentRoute == 'stats.index' ? 'underline text-green-100 font-bold' : 'md:hover:text-blue-500' }}">
              Gestionar Usuarios
            </a>
          </li>
        @else
          <!-- Navbar para usuarios normales -->
          <li>
            <a href="{{route('home')}}" title="Inicio"
              class="flex flex-col items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent">
              <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"></path> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"></path> </g> </g> </g> </g></svg>
              <span class="{{ $currentRoute == 'home' ? 'block w-full h-1 bg-white rounded-t mt-1' : '' }}"></span>
            </a>
          </li>
          <li>
            <a href="{{route('stats.index')}}" title="Gestionar Actividades"
              class="flex flex-col items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent">
              <svg fill="#ffffff" width="20px" height="20px" viewBox="0 0 16 16" id="table-3-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_29" data-name="Path 29" d="M37.5,0h-11A2.5,2.5,0,0,0,24,2.5v11A2.5,2.5,0,0,0,26.5,16h11A2.5,2.5,0,0,0,40,13.5V2.5A2.5,2.5,0,0,0,37.5,0Zm-11,1h11A1.5,1.5,0,0,1,39,2.5V4H25V2.5A1.5,1.5,0,0,1,26.5,1ZM25,13.5V5h4V15H26.5A1.5,1.5,0,0,1,25,13.5ZM37.5,15H30V5h9v8.5A1.5,1.5,0,0,1,37.5,15ZM26,6.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,0,1h-1A.5.5,0,0,1,26,6.5Zm2,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,9.5Zm0,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,12.5Zm10-6a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,6.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,9.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,12.5Z" transform="translate(-24)"></path> </g></svg>
              <span class="{{ $currentRoute == 'stats.index' ? 'block w-full h-1 bg-white rounded-t mt-1' : '' }}"></span>
            </a>
          </li>
          <li>
            <a href="{{route('perfil.index')}}" title="Perfil"
              class="flex flex-col items-center  rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent">
              <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 45.532 45.532" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765 S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53 c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012 c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592 c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"></path> </g> </g></svg>
              <span class="{{ $currentRoute == 'perfil.index' ? 'block w-full h-1 bg-white rounded-t mt-1' : '' }}"></span>
            </a>
          </li>
        @endif
        <li>
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" title="Cerrar Sesión"
              class="flex items-center py-0 px-0 rounded md:border-0 md:p-0 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent">
              <?xml version="1.0" ?><svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8" stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
@endauth

<!-- CONTENIDO -->
<div class="flex-grow p-0">
    @yield('contenido')
</div>

<!-- FOOTER -->
<footer class="bg-[#04845c] text-white py-4 mt-auto">
  <div class="container mx-auto text-center">
    <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
  </div>
</footer>

@yield('scripts')
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>



</body>
</html>
