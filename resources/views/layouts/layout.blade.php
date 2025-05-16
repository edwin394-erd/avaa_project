<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <title>@yield('titulo-tab')</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body class="bg-blue-100 h-screen flex flex-col p-0">

<!-- NAV BAR -->
    
@guest
<nav class="border-gray-200 bg-green-800 shadow-2xl" >
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
        <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-28" alt="avaa Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowraptext-white text-white">Stats</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2  text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border  rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  md:bg-green-800 border-gray-700">
        <li>
          <a href="{{route('login')}}" class="block py-2 px-3  rounded  md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Iniciar Sesión</a>
        </li>
        <li>
          <a href="{{route('register')}}" class="block py-2 px-3  rounded  md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Registrarse</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
@endguest

@auth
<nav class="border-gray-200 bg-green-800 shadow-2xl">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
        <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-28" alt="avaa Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Stats</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-green-800 border-gray-700">
        
        <!-- Navbar para usuarios admin -->
        @if(auth()->user()->role == 'admin')
          <li>
            <a href="{{route('home')}}" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Panel Admin</a>
          </li>
          <li>
            <a href="{{route('home')}}" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Ver Estadísticas</a>
          </li>
        @else
          <!-- Navbar para usuarios normales -->
          <li>
            <a href="{{route('home')}}" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Inicio</a>
          </li>
          <li>
            <a href="{{route('stats.index')}}" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Gestionar Estadísticas</a>
          </li>
          <li>
            <a href="{{route('test')}}" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Perfil</a>
          </li>
        @endif

        <li>
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="block py-2 px-3 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent">Cerrar Sesión</button>
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
<footer class="bg-green-800 text-white py-4 mt-auto">
  <div class="container mx-auto text-center">
    <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
  </div>
</footer>

@yield('scripts')
<script src="{{ mix('js/app.js') }}"></script>


</body>
</html>
