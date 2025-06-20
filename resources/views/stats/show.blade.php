@extends('layouts.layout')

@section('titulo-tab')
@php
    switch($modalidad) {
        case "volin":
            $n_actividad = "Voluntariado Interno";
            $color = "text-[#28a745]";
            $bgcolor = "bg-[#e3f7e7]";
            $bgcolor2 = "bg-[#28a745]";
            $icono = "icon-volin.png";
            $meta = $meta_volin ?? 0;
            $hover = "hover:bg-[#d4f0d4] dark:hover:bg-green-900/40";
            break;
        case "volex":
            $n_actividad = "Voluntariado Externo";
            $color = "text-[#dc3545]";
            $bgcolor = "bg-[#f9e5e7]";
            $bgcolor2 = "bg-[#dc3545]";
            $icono = "icon-volex.png";
            $meta = $meta_volex ?? 0;
            $hover = "hover:bg-[#f9e5e7] dark:hover:bg-red-900/40";
            break;
        case "chat":
            $n_actividad = "Chats";
            $color = "text-[#fd7e14]";
            $bgcolor = "bg-[#fcf2ea]";
            $bgcolor2 = "bg-[#fd7e14]";
            $icono = "icon-chat.png";
            $meta = $meta_chat ?? 0;
            $hover = "hover:bg-[#f8e6d9] dark:hover:bg-yellow-900/40";
            break;
        case "taller":
            $n_actividad = "Talleres";
            $color = "text-[#007bff]";
            $bgcolor = "bg-[#e0eaff]";
            $bgcolor2 = "bg-[#007bff]";
            $icono = "icon-taller.png";
            $meta = $meta_taller ?? 0;
            $hover = "hover:bg-[#d1e0f5] dark:hover:bg-blue-900/40";
            break;
        default:
            $n_actividad = "Detalle";
            $color = "text-gray-700";
            $bgcolor = "bg-gray-100";
            $bgcolor2 = "bg-gray-700";
            $icono = "icono-default.png";
            $meta = "Meta no definida";
            break;
    }
@endphp
    Estadisticas de {{ $n_actividad }}
@endsection

@section('contenido')
<div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-5">
    <div id="contenedor-principal" class="flex flex-wrap min-h-[calc(90vh-4rem)] xl:flex-nowrap p-0 h-full">
         <!-- Columna izquierda -->
       <div id="formulario-izquierda" class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0 order-2 xl:order-1 transition-all duration-500">
              <div class="relative flex flex-col bg-white dark:bg-slate-900 border dark:border-gray-700 shadow-xl shadow-gray-100 dark:shadow-gray-900 rounded-l-xl p-4 h-full">
            <button id="toggle-form-btn"
                cl                <button id="toggle-form-btn"
                    class="absolute top-2 right-2 z-20 px-2 py-1 bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 dark:bg-slate-700 dark:text-gray-100 dark:border-slate-700 dark:hover:bg-slate-800 rounded transition-all duration-300 hidden xl:block"
                    style="min-width:32px;min-height:32px;">
                    <span id="toggle-form-icon">⮜</span>
                </button>
                <div class="flex items-center space-x-3 mb-3 text-center">
                    <img src="{{ asset('imgs/' . $icono)}}" alt="icono" class="w-10 h-10 2xl:w-12 2xl:h-12">
                    <h1 class="text-sm 2xl:text-xl font-bold {{ $color }} mb-0 flex items-center"> {{ $n_actividad }}</h1>
                </div>
                @php
                    $totalRealizadas = $stats_realizado->count();
                    $totalHoras = $stats_realizado->sum('duracion');
                    $porcentaje = $meta > 0 ? min(100, round(($totalHoras / $meta) * 100)) : 0;
                @endphp
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300 text-sm">Total actividades realizadas:</span>
                        <span class="font-bold text-md 2xl:text-lg text-gray-900 dark:text-gray-100">{{ $totalRealizadas }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300 text-sm">Total horas realizadas:</span>
                        <span class="font-bold text-md 2xl:text-lg text-gray-900 dark:text-gray-100">{{ $totalHoras }}h</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-4 overflow-hidden">
                        <div class="h-4 rounded-full {{ $bgcolor2 }} transition-all duration-700 ease-in-out" style="width: 0%" id="barra-progreso"></div>
                    </div>
                    <div class="text-right text-xs text-gray-700 dark:text-gray-200 mt-1">
                        Progreso: <span class="font-semibold">{{ $porcentaje }}%</span>
                    </div>
                    <div class="text-right text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <span>Meta: {{ $meta }} horas</span>
                    </div>
                </div>
                <br>
                <hr class="dark:border-slate-700">
                <div class="flex items-center 2xl:mb-4">
                     <img src="{{ asset('imgs/icon-progen.png') }}" alt="icono" class="w-12 h-12 block dark:hidden">
                    <img src="{{ asset('imgs/icon-progen-blanco.png') }}" alt="icono" class="w-12 h-12 hidden dark:block">
                    <h3 class="text-sm 2xl:text-lg font-bold text-gray-800 dark:text-gray-100 ml-2 ">Estadísticas mensuales</h3>
                </div>

                <div id="bar-chart"></div>
            </div>
        </div>
         <!-- Columna derecha -->
        <div id="tabla-derecha" class="w-full xl:w-3/4 p-0 flex flex-col order-1 xl:order-2 transition-all duration-500">
            <div class="flex flex-col bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 gap-2">
                    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <button type="button" id="abrir-modal-filtrar-fecha"
                            class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 focus:ring-4 focus:ring-gray-100 dark:focus:ring-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                            Filtrar por fecha
                        </button>
                        <a href="{{ route('stats.modalidadindex', $modalidad) }}" id="btn-ver-todo"
                            class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                            Ver todo
                        </a>
                        @if ($user->role == 'admin')
                            <button type="button" id="btn-generar-reporte-admin"
                                class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                                Generar reporte
                            </button>
                        @else
                            <button type="button" id="btn-generar-reporte"
                                class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                                Generar reporte
                            </button>
                        @endif
                    </div>
                    <div id="modal-filtrar-fecha"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
                            <h2 class="text-lg text-gray-700 dark:text-gray-100 font-bold mb-4 text-center">Filtrar actividades por fecha</h2>
                            <button type="button" id="cerrar-modal-filtrar-fecha"
                                class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                            <form method="GET" action="{{ route('stats.modalidadindex', $modalidad) }}" class="flex flex-col gap-4">
                                <div>
                                    <label for="fecha-inicio"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Fecha de inicio</label>
                                    <input type="date" id="fecha-inicio" name="fecha_inicio"
                                        class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100"
                                        max="{{ now()->toDateString() }}" required>
                                </div>
                                <div>
                                    <label for="fecha-fin" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Fecha de fin</label>
                                    <input type="date" id="fecha-fin" name="fecha_fin"
                                        class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100"
                                        max="{{ now()->toDateString() }}" required>
                                </div>
                                <button type="submit"
                                    class="bg-slate-800 hover:bg-slate-700 text-white font-medium rounded px-4 py-2 mt-2">Aplicar filtro</button>
                            </form>
                        </div>
                    </div>
                    <!-- Buscador -->
                    <form method="GET" action="{{ route('stats.modalidadindex', $modalidad) }}" class="flex items-center w-full sm:w-auto mt-2 sm:mt-0">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="table-search"
                                value="{{ request('search') }}"
                                class="block p-2 ps-10 text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-slate-700 rounded-lg w-full sm:w-80 bg-gray-50 dark:bg-slate-800 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Buscar">
                        </div>
                        <button type="submit" class="ml-2 px-3 py-1 text-slate rounded border dark:text-gray-100 bg-white dark:bg-slate-800 border-gray-300 dark:border-slate-700">Buscar</button>
                    </form>
                </div>
                <div class="flex-1 min-h-0 overflow-y-auto">
                     <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-100 table-auto bg-white dark:bg-slate-900" id="myTable">
                        <thead class="text-gray-700 dark:text-gray-200 text-md uppercase border-b border-gray-200 dark:border-slate-700">
                            <tr>
                                @if ($user->role == 'admin')
                                    <th class="p-1 2xl:px-3 2xl:py-3 text-center">BECARIO</th>
                                @endif
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Titulo</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Actividad</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Fecha</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Modalidad</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Duración</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Ver evidencias</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md text-center">Estatus</th>
                                <th scope="col" class="p-1 2xl:px-3 2xl:py-3 text-sm 2xl:text-md"> Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
@forelse ($stats as $stat)
    <tr id="stat-{{ $stat->id }}" class="bg-white dark:bg-slate-900 text-sm border-b border-gray-200 dark:border-slate-700 transition duration-300 ease-in-out {{ $hover }} text-sm">
        @if ($user->role == 'admin')
            <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-center gap-2">
                    @if($stat->becario && $stat->becario->user && $stat->becario->user->fotoperfil)
                        <img src="{{ asset('storage/' . $stat->becario->user->fotoperfil) }}" alt="Foto de perfil" class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                    @else
                        <img src="{{ asset('imgs/default-profile.jpg') }}" alt="Foto de perfil" class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                    @endif
                    <a href="{{ route('users.showbecario', $stat->becario->user->id ?? '') }}">
                        <span class="hover:underline text-blue-700 dark:text-blue-300 cursor-pointer">
                            {{ $stat->becario->nombre ?? '' }} {{ $stat->becario->apellido ?? '' }}
                        </span>
                    </a>
                </div>
            </td>
        @endif
        <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">{{ $stat->titulo }}</td>
        <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">
            @switch($stat->actividad)
                @case('chat') Chat @break
                @case('taller') Taller de Formación @break
                @case('volin') Voluntariado Interno @break
                @case('volex') Voluntariado Externo @break
                @default {{ $stat->actividad }}
            @endswitch
        </td>
        <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">
            {{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }}
        </td>
        <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">
            @switch($stat->modalidad)
                @case('presencial') Presencial @break
                @case('online') Online @break
                @default {{ $stat->modalidad }}
            @endswitch
        </td>
        <td class="px-3 py-4 text-center text-gray-900 dark:text-gray-100">{{ $stat->duracion }}</td>
        <td class="px-3 py-4 text-center">
            <button class="rounded p-2 text-white bg-white ver-evidencias-btn hover:bg-blue-100 dark:bg-transparent"
                data-evidencias='@json($stat->evidencias->pluck('ruta_imagen'))' type="button">
                <svg width="25px" height="25px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <g>
                        <defs>
                            <style>
                                .a { fill: none; stroke: #166534; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3.5; }
                            </style>
                        </defs>
                        <path class="a" d="M43.5,24a22.5049,22.5049,0,0,0-39,0"></path>
                        <circle class="a" cx="24" cy="24" r="7.889"></circle>
                        <path class="a" d="M4.5,24a22.5049,22.5049,0,0,0,39,0"></path>
                    </g>
                </svg>
            </button>
        </td>
        <td class="px-3 py-4 text-center">
            @if ($stat->anulado == 'SI')
                <span class="bg-gray-300 dark:bg-gray-700 p-1 text-bold rounded text-gray-900 dark:text-gray-100">ANULADO</span>
            @elseif ($stat->estado == 'pendiente')
                <span class="bg-yellow-200 dark:bg-yellow-700 p-1 text-bold rounded text-gray-900 dark:text-gray-100">PENDIENTE</span>
            @elseif ($stat->estado == 'rechazado')
                <span class="bg-red-300 dark:bg-red-700 p-1 text-bold rounded cursor-pointer text-gray-900 dark:text-gray-100"
                    onclick="abrirModal('modal-motivo-rechazo-{{ $stat->id }}')" title="Ver motivo de rechazo">
                    RECHAZADO
                </span>
            @else
                <span class="bg-green-200 dark:bg-green-700 p-1 text-bold rounded text-gray-900 dark:text-gray-100">APROBADO</span>
            @endif
        </td>
        <td class="px-2 py-2 text-center">
            @if ($user->role == 'admin')
                <div class="flex p-0">
                    @if ($stat->estado == 'aprobado')
                        <button disabled class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"><path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#318b18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </button>
                    @else
                        <button onclick="abrirModal('modal-aprobar-{{ $stat->id }}')" class="block text-white focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"><path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#318b18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </button>
                    @endif
                    @if ($stat->estado == 'rechazado')
                        <button disabled class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.68342 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#af1212"></path></svg>
                        </button>
                    @else
                        <button onclick="abrirModal('modal-rechazar-{{ $stat->id }}')" class="block text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.68342 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#af1212"></path></svg>
                        </button>
                    @endif
                </div>
            @else
                @if ($stat->anulado == 'NO')
                     <button onclick="abrirModal('modal-anular-{{ $stat->id }}')" @if ($stat->estado != 'pendiente') disabled class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center" @else class="block text-white focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center" @endif>
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10.5" stroke="#da3232" stroke-width="1.91" fill="none"></circle><line x1="19.64" y1="4.36" x2="4.36" y2="19.64" stroke="#da3232" stroke-width="1.91"></line></svg>
                    </button>
                @elseif ($stat->anulado == 'SI')
                    <button onclick="abrirModal('modal-restaurar-{{ $stat->id }}')"
                        @if ($stat->estado != 'pendiente') disabled
                            class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center -translate-x-0.5"
                        @else
                            class="block text-white focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center -translate-x-0.5"
                        @endif>
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                            width="35px" height="35px"
                            viewBox="0 0 900.000000 900.000000"
                            preserveAspectRatio="xMidYMid meet"
                            class="restore-icon-svg">
                            <g transform="translate(0.000000,900.000000) scale(0.100000,-0.100000)"
                             stroke="none">
                                <path
                                    d="M4440 7915 c-25 -13 -54 -29 -65 -34 -11 -6 -27 -15 -35 -21 -22 -15
                            -212 -125 -230 -133 -8 -4 -28 -16 -45 -27 -16 -11 -39 -24 -51 -29 -19 -8
                            -137 -77 -174 -101 -8 -6 -22 -13 -30 -17 -8 -4 -70 -40 -138 -80 -68 -40
                            -125 -73 -127 -73 -4 0 -249 -143 -275 -160 -8 -6 -22 -13 -30 -17 -8 -4 -48
                            -26 -88 -50 -40 -24 -74 -43 -77 -43 -2 0 -24 -13 -48 -30 -66 -44 -75 -80
                            -29 -122 15 -14 34 -28 42 -32 8 -3 29 -15 45 -26 17 -11 39 -24 50 -30 11 -6
                            29 -16 40 -23 11 -7 52 -30 90 -52 39 -22 79 -45 90 -52 11 -7 27 -16 35 -20
                            18 -9 260 -150 280 -163 8 -6 22 -13 30 -17 8 -4 59 -33 113 -65 55 -32 100
                            -58 102 -58 3 0 251 -144 275 -160 8 -6 22 -13 30 -17 8 -4 51 -28 95 -54 176
                            -103 180 -104 220 -64 l25 24 0 239 c0 189 3 242 13 251 10 8 44 8 123 1 250
                            -24 426 -64 683 -155 79 -28 246 -108 322 -154 19 -12 41 -24 49 -28 31 -13
                            179 -114 250 -169 178 -137 326 -288 471 -479 181 -239 327 -542 403 -832 69
                            -267 80 -359 80 -653 -1 -247 -8 -324 -50 -510 -75 -332 -188 -595 -370 -865
                            -78 -115 -106 -150 -203 -259 -153 -172 -352 -339 -548 -459 -102 -63 -352
                            -187 -376 -187 -9 0 -18 -4 -22 -9 -3 -5 -20 -13 -38 -17 -17 -3 -45 -12 -62
                            -19 -176 -73 -539 -135 -790 -135 -258 0 -593 57 -807 136 -229 85 -370 155
                            -564 280 -242 156 -501 415 -686 684 -24 36 -47 72 -51 80 -4 8 -23 42 -42 75
                            -35 60 -81 153 -128 255 -44 98 -110 310 -140 450 -38 174 -47 275 -47 515 0
                            238 8 323 46 500 31 142 106 391 125 410 5 5 9 15 9 23 0 13 113 248 143 297
                            63 104 114 178 189 276 59 79 88 125 88 143 0 21 -42 69 -204 232 -241 242
                            -246 245 -319 173 -69 -69 -266 -339 -317 -434 -6 -11 -19 -33 -29 -50 -11
                            -16 -50 -91 -86 -165 -37 -74 -70 -142 -74 -150 -17 -33 -81 -198 -81 -208 0
                            -6 -6 -26 -14 -44 -56 -133 -115 -395 -151 -668 -20 -156 -20 -535 0 -695 68
                            -527 229 -966 514 -1400 137 -210 341 -442 546 -620 108 -95 361 -283 415
                            -308 8 -4 29 -16 45 -27 66 -42 284 -153 385 -196 395 -166 806 -249 1230
                            -249 423 0 834 83 1230 249 78 33 293 140 335 167 17 10 39 23 50 29 98 52
                            327 219 460 335 501 437 850 1023 999 1675 62 275 79 445 73 745 -5 274 -22
                            434 -69 625 -6 25 -14 63 -19 85 -4 22 -17 72 -29 110 -11 39 -25 84 -30 100
                            -15 54 -67 190 -105 280 -116 268 -317 590 -499 800 -63 73 -249 261 -326 331
                            -63 57 -269 210 -370 276 -155 100 -414 233 -554 284 -100 37 -341 114 -354
                            114 -9 0 -38 6 -66 14 -124 36 -376 73 -533 80 -56 2 -107 7 -112 11 -7 4 -11
                            91 -11 258 0 139 -3 261 -6 273 -4 17 -52 56 -66 53 -1 0 -23 -11 -48 -24z" />
                            </g>
                        </svg>
                    </button>
                    <style>
                        .restore-icon-svg {
                            /* Default: black */
                            fill: #000;
                            /* For dark mode, override with light gray */
                        }
                        html.dark .restore-icon-svg {
                            fill: #d1d5db !important; /* Tailwind slate-300 */
                        }
                    </style>
                @endif
            @endif
        </td>
    </tr>
    <!-- Modal ANULAR -->
    <div id="modal-anular-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar anulación</h2>
            <h2 class="text-sm mb-4 text-center text-gray-700 dark:text-gray-200"> Actividad: {{ $stat->titulo }} ({{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }})</h2>
            <hr class="dark:border-slate-700"><br>
            <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
            <div class="flex flex-col items-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-300 text-center">¿Estás seguro de que quieres anular esta actividad?</h3>
                <hr class="dark:border-slate-700"><br>
                <div class="text-center">
                    <form action="{{ route('stat.anular', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">Sí, estoy seguro</button>
                    </form>
                    <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-3">No, cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal RESTAURAR -->
    <div id="modal-restaurar-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar restauración</h2>
            <h2 class="text-sm mb-4 text-center text-gray-700 dark:text-gray-200"> Actividad: {{ $stat->titulo }} ({{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }})</h2>
            <hr class="dark:border-slate-700"><br>
            <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
            <div class="flex flex-col items-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-300 text-center">¿Estás seguro de que quieres restaurar esta actividad?</h3>
                <hr class="dark:border-slate-700"><br>
                <div class="text-center">
                    <form action="{{ route('stat.restaurar', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                        @csrf
                        <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">Sí, estoy seguro</button>
                    </form>
                    <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-3">No, cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal APROBAR -->
    <div id="modal-aprobar-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar aprobación</h2>
            <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200"> Actividad: {{ $stat->titulo }} ({{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }})</h2>
            <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200"> Becario: {{ optional($stat->becario)->nombre ?? '-' }} {{ optional($stat->becario)->apellido ?? '-' }}</h2>
            <hr class="dark:border-slate-700"><br>
            <button type="button" onclick="cerrarModal('modal-aprobar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
            <div class="flex flex-col items-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-300 text-center">¿Estás seguro de que quieres aprobar esta actividad?</h3>
                <hr class="dark:border-slate-700"><br>
                <div class="text-center">
                    <form action="{{ route('stat.aprobar', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                        @csrf
                        <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">Sí, estoy seguro</button>
                    </form>
                    <button type="button" onclick="cerrarModal('modal-aprobar-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-3">No, cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal RECHAZAR -->
    <div id="modal-rechazar-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar rechazo</h2>
            <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200"> Actividad: {{ $stat->titulo }} ({{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }})</h2>
             <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200"> Becario: {{ optional($stat->becario)->nombre ?? '-' }} {{ optional($stat->becario)->apellido ?? '-' }}</h2>
            <hr class="dark:border-slate-700"><br>
            <button type="button" onclick="cerrarModal('modal-rechazar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
            <div class="flex flex-col items-center">
                <h3 class="mb-2 text-md font-normal text-gray-700 dark:text-gray-200 text-center">¿Estás seguro de que quieres rechazar esta actividad?</h3>
                <hr class="dark:border-slate-700">
                <form action="{{ route('stat.rechazar', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                    <div class="w-full flex flex-col items-center mb-4">
                        <label for="observacion" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2 text-left">Motivo</label>
                        <textarea name="observacion" id="observacion" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-400 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300" placeholder="Escribe el motivo del rechazo" rows="3">{{ $stat->observacion }}</textarea>
                    </div>
                    <div class="text-center">
                        @csrf
                        <button type="submit" class="bg-slate-700 hover:bg-slate-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">Sí, estoy seguro</button>
                    </div>
                </form>
                <button type="button" onclick="cerrarModal('modal-rechazar-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-3">No, cancelar</button>
            </div>
        </div>
    </div>
    <!-- Modal MOTIVO DE RECHAZO -->
    <div id="modal-motivo-rechazo-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
            <h2 class="text-lg font-bold mb-4 text-center text-red-700 dark:text-red-400">Motivo de Rechazo</h2>
            <button type="button" onclick="cerrarModal('modal-motivo-rechazo-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
            <div class="text-gray-700 dark:text-gray-200 text-center mb-2">
                <span class="font-semibold">Actividad:</span> {{ $stat->titulo }}<br>
                <span class="font-semibold">Fecha:</span> {{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }}
            </div>
            <hr class="mb-4 dark:border-slate-700">
            <div class="text-red-700 dark:text-red-400 text-center italic">
                {{ $stat->observacion ?: 'Sin motivo especificado.' }}
            </div>
            <div class="flex justify-center mt-4">
                <button type="button" onclick="cerrarModal('modal-motivo-rechazo-{{ $stat->id }}')" class="py-2 px-4 text-sm font-medium text-white focus:outline-none bg-slate-800 dark:bg-slate-700 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-slate-900 dark:hover:bg-slate-900">Cerrar</button>
            </div>
        </div>
    </div>
@empty
    <tr>
        <td colspan="8" class="p-10 text-center uppercase text-gray-500 dark:text-gray-400 align-middle">No hay estadísticas</td>
    </tr>
@endforelse
                        </tbody>
                    </table>

                </div>
                {{-- PAGINACION --}}
                <div class="mt-2 flex flex-col items-center">
                    <div class="flex gap-1 mb-1">
                        @if ($stats->onFirstPage())
                            <button class="px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-400 rounded text-xs" disabled>&laquo;</button>
                        @else
                            <a href="{{ $stats->previousPageUrl() }}" class="px-2 py-1 bg-slate-800 text-white rounded text-xs hover:bg-slate-700">&laquo;</a>
                        @endif

                        <span class="px-2 py-1 text-xs text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-slate-800 rounded">
                            {{ $stats->currentPage() }}/{{ $stats->lastPage() }}
                        </span>

                        @if ($stats->hasMorePages())
                            <a href="{{ $stats->nextPageUrl() }}" class="px-2 py-1 bg-slate-800 text-white rounded text-xs hover:bg-slate-700">&raquo;</a>
                        @else
                            <button class="px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-400 rounded text-xs" disabled>&raquo;</button>
                        @endif
                    </div>
                </div>
                <!-- Modal para evidencias (fuera del loop) -->
                <div id="modal-evidencias" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-lg w-full relative min-h-80 flex flex-col items-center">
                        <div class="w-full text-center">
                            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Evidencias</h2>
                            <h2 class="text-sm mb-4 text-center text-gray-700 dark:text-gray-200" id="titulo-evidencia"></h2>
                        </div>
                        <button onclick="cerrarModalEvidencias()" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-2xl">&times;</button>
                        <div class="flex-1 flex items-center justify-center w-full">
                            <div id="contenedor-evidencias" class="flex flex-wrap gap-2 justify-center items-center w-full"></div>
                        </div>
                    </div>
                </div>
                <!-- Modal para imagen ampliada (fuera del loop) -->
                <div id="modal-img-ampliada" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[9999] hidden">
                    <img id="img-ampliada" src="" alt="Evidencia ampliada" class="max-h-[90vh] max-w-[90vw] rounded shadow-lg border-4 border-white">
                    <button onclick="cerrarModalImgAmpliada()" class="absolute top-4 right-6 text-white text-4xl font-bold">&times;</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<!-- =========================
    FUNCIONES DE MODALES Y EVIDENCIAS
========================= -->
<script>
// Enviar ambos formularios con el btn_enviar
function enviarFormularios() {
    document.querySelector('form[action="{{ route('stat.store') }}"]').submit();
}

// Mostrar evidencias en el modal con animación
document.querySelectorAll('.ver-evidencias-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const evidencias = JSON.parse(this.dataset.evidencias);
        const contenedor = document.getElementById('contenedor-evidencias');
        contenedor.innerHTML = '';
        if (evidencias.length === 0) {
            const mensaje = document.createElement('p');
            mensaje.textContent = 'Esta actividad no tiene evidencias';
            mensaje.className = 'text-gray-500 text-center w-full';
            contenedor.appendChild(mensaje);
        } else {
            evidencias.forEach(ruta => {
                const img = document.createElement('img');
                img.src = '/' + ruta;
                img.className = 'w-24 h-24 object-cover rounded border';
                contenedor.appendChild(img);
            });
        }
        const modal = document.getElementById('modal-evidencias');
        modal.style.display = 'flex';
        modal.classList.add('transition', 'duration-200', 'ease-out');
        modal.style.opacity = 0;
        const content = modal.querySelector('div.bg-white');
        if (content) {
            content.style.transform = 'scale(0.95)';
            content.style.opacity = 0;
            content.style.transition = 'transform 0.2s ease, opacity 0.2s ease';
        }
        setTimeout(() => {
            modal.style.opacity = 1;
            if (content) {
                content.style.transform = 'scale(1)';
                content.style.opacity = 1;
            }
        }, 10);
    });
});

function cerrarModalEvidencias() {
    const modal = document.getElementById('modal-evidencias');
    const content = modal.querySelector('div.bg-white');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
    }
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.style.display = 'none';
        if (content) {
            content.style.transform = '';
            content.style.opacity = '';
        }
    }, 200);
}
</script>

<!-- =========================
    MODAL FILTRAR POR FECHA
========================= -->
<script>
const abrirBtn = document.getElementById('abrir-modal-filtrar-fecha');
if (abrirBtn) {
    abrirBtn.addEventListener('click', function() {
        abrirModal('modal-filtrar-fecha');
        document.getElementById('form-filtrar-fecha').reset();
        const hoy = new Date().toISOString().split('T')[0];
        document.getElementById('fecha-inicio').setAttribute('max', hoy);
        document.getElementById('fecha-fin').setAttribute('max', hoy);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const cerrarBtn = document.getElementById('cerrar-modal-filtrar-fecha');
    if (cerrarBtn) {
        cerrarBtn.addEventListener('click', function() {
            cerrarModal('modal-filtrar-fecha');
        });
    }
});
</script>

<!-- =========================
    FUNCIONES GENERALES DE MODALES
========================= -->
<script>
function abrirModal(id) {
    const modal = document.getElementById(id);
    modal.style.display = 'flex';
    modal.classList.add('transition', 'duration-200', 'ease-out');
    modal.style.opacity = 0;
    // Animar solo el contenido, no el fondo
    const content = modal.querySelector('div.bg-white');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
        content.style.transition = 'transform 0.2s ease, opacity 0.2s ease';
    }
    setTimeout(() => {
        modal.style.opacity = 1;
        if (content) {
            content.style.transform = 'scale(1)';
            content.style.opacity = 1;
        }
    }, 10);
}
function cerrarModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div.bg-white');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
    }
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.style.display = 'none';
        if (content) {
            content.style.transform = '';
            content.style.opacity = '';
        }
    }, 200);
}

// Mostrar imagen ampliada al hacer click
document.getElementById('contenedor-evidencias').addEventListener('click', function(e) {
    if (e.target.tagName === 'IMG') {
        document.getElementById('img-ampliada').src = e.target.src;
        abrirModal('modal-img-ampliada');
    }
});

function cerrarModalImgAmpliada() {
    cerrarModal('modal-img-ampliada');
    setTimeout(() => {
        document.getElementById('img-ampliada').src = '';
    }, 200);
}

document.getElementById('modal-img-ampliada').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalImgAmpliada();
    }
});
</script>

<!-- =========================
    DROPZONE Y ENVÍO DE FORMULARIOS
========================= -->
<script>
document.querySelector('button[onclick="enviarFormularios()"]').addEventListener('click', function(e) {
    // Si Dropzone está subiendo archivos o hay archivos en cola
    if (myDropzone.getUploadingFiles().length > 0 || myDropzone.getQueuedFiles().length > 0) {
        e.preventDefault();
        alert('Por favor espera a que se suban todas las imágenes antes de enviar el formulario.');
        return false;
    }
    // Si no, envía el formulario principal
    document.querySelector('form[action="{{ route('stat.store') }}"]').submit();
});
</script>

<!-- =========================
    ANIMACIÓN DE BARRA DE PROGRESO
========================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const barra = document.getElementById('barra-progreso');
    if (barra) {
        // Guarda el valor final
        const porcentaje = '{{ $porcentaje }}';
        // Inicializa la barra en 0% sin transición
        barra.style.transition = 'none';
        barra.style.width = '0%';
        // Fuerza el reflow para que el navegador registre el cambio a 0%
        barra.offsetHeight; // trigger reflow
        // Usa setTimeout para animar al valor real
        setTimeout(() => {
            barra.style.transition = 'width 1s cubic-bezier(0.4,0,0.2,1)';
            barra.style.width = porcentaje + '%';
        }, 100);
    }
});
</script>

<!-- =========================
    GRÁFICO DE BARRAS (APEXCHARTS)
========================= -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let dataPorMes;
    switch ("{{ $modalidad }}") {
        case "volin":
            dataPorMes = @json($total_volin_por_mes);
            break;
        case "volex":
            dataPorMes = @json($total_volex_por_mes);
            break;
        case "taller":
            dataPorMes = @json($total_taller_por_mes);
            break;
        case "chat":
            dataPorMes = @json($total_chat_por_mes);
            break;
        default:
    }
    // Obtener la fecha actual
    const currentDate = new Date();

    // Función para obtener los índices de los últimos 6 meses
    function getLastSixMonthIndexes() {
        const indexes = [];
        for (let i = 5; i >= 0; i--) {
            indexes.push((currentDate.getMonth() - i + 12) % 12);
        }
        return indexes;
    }

    const lastSixMonthIndexes = getLastSixMonthIndexes();

    // Extraer los últimos 6 meses de la actividad seleccionada según $modalidad
    let horasUltimos6Meses = lastSixMonthIndexes.map(index => dataPorMes[(index + 1) % 12] ?? 0);

    // Obtener los nombres de los últimos 6 meses
    function getLastSixMonths() {
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        return lastSixMonthIndexes.map(index => months[index]);
    }

    let months = getLastSixMonths(); // Obtenemos los últimos 6 meses dinámicamente

    // Detectar si el gráfico será horizontal
    const isHorizontal = window.innerWidth < 640;

    // Si es horizontal, invertir el orden de los datos y los meses
    if (isHorizontal) {
        months = months.slice().reverse();
        horasUltimos6Meses = horasUltimos6Meses.slice().reverse();
    }

    // Alternar sombreado de fondo para cada mes según el modo (claro/dark)
    function getBarColors() {
        const isDark = document.documentElement.classList.contains('dark');
        if (isDark) {
            return months.map((_, i) => i % 2 === 0 ? "#1e293b" : "#0f172a"); // dark
        } else {
            return months.map((_, i) => i % 2 === 0 ? "#E5E7EB" : "#FFFFFF"); // light
        }
    }

    function renderChart() {
        const barColors = getBarColors();
        const isDark = document.documentElement.classList.contains('dark');
        const colorMap = {
            volin: "#16A34A",
            volex: "#dc2626",
            chat: "#f97316",
            taller: "#2563EB"
        };
        const nombreMap = {
            volin: "Voluntariado Interno",
            volex: "Voluntariado Externo",
            chat: "Chat",
            taller: "Talleres"
        };
        const options2 = {
            series: [{
                name: nombreMap["{{ $modalidad }}"] ?? "Actividad",
                color: colorMap["{{ $modalidad }}"] ?? "#2563EB",
                data: horasUltimos6Meses,
            }],
            chart: {
                sparkline: { enabled: false },
                type: "bar",
                width: "100%",
                height: (() => {
                    const el = document.getElementById("bar-chart");
                    const ww = window.innerWidth;
                    if (el) {
                        if (ww >= 1536) return 390;
                        if (ww >= 1280) return 280;
                        if (ww >= 900) return 250;
                        if (ww >= 640) return 200;
                        return 160;
                    }
                    if (ww >= 1536) return 420;
                    if (ww >= 1280) return 350;
                    if (ww >= 900) return 300;
                    if (ww >= 640) return 220;
                    return 160;
                })(),
                toolbar: { show: false },
                background: isDark ? "#0f172a" : "#fff"
            },
            plotOptions: {
                bar: {
                    horizontal: isHorizontal,
                    columnWidth: "80%",
                    borderRadiusApplication: "end",
                    borderRadius: 6,
                    dataLabels: {
                        position: window.innerWidth >= 640 ? "top" : "center",
                    },
                },
            },
            legend: { show: false },
            tooltip: {
                enabled: false,
                shared: true,
                intersect: false,
                fillSeriesColor: false,
                x: { show: true },
                y: {
                    formatter: function (value) {
                        return `${nombreMap["{{ $modalidad }}"] ?? "Actividad"}: ${value} Horas`;
                    }
                },
            },
            xaxis: {
                categories: months,
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500'
                    }
                },
                axisTicks: { show: false },
                axisBorder: { show: false },
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500'
                    }
                },
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: { left: 2, right: 2, top: -20 },
                row: { colors: isHorizontal ? barColors : undefined },
                column: { colors: !isHorizontal ? barColors : undefined },
            },
            fill: { opacity: 1 }
        };

        if (window.chart) {
            window.chart.destroy();
        }
        window.chart = new ApexCharts(document.getElementById("bar-chart"), options2);
        window.chart.render();
    }

    renderChart();

    // Actualiza el grid y fondo al cambiar el modo claro/oscuro
    const toggleDark = document.getElementById('toggle-dark');
    if (toggleDark) {
        toggleDark.addEventListener('click', function() {
            renderChart();
        });
    }
});
</script>

<!-- =========================
    FUNCIONES DE TABLA, FILTRO Y REPORTE PDF
========================= -->
<script>
let allStats = [];
let filteredStats = [];
let isAdmin = @json($user->role === 'admin');

// Cargar todos los registros al cargar la página
fetch("{{ route('stats.all.modalidad', $modalidad) }}")
    .then(res => res.json())
    .then(data => {
        allStats = data;
        filteredStats = data;
    });

// Botón "Ver todo" para limpiar el filtro y mostrar todas las filas
document.getElementById('btn-ver-todo').addEventListener('click', function() {
    document.getElementById('table-search').value = '';
    document.querySelectorAll('#myTable tbody tr').forEach(row => {
        row.style.display = '';
    });
    filteredStats = allStats;
});

// Reporte PDF usando los datos ya cargados
function toDataURL(url, callback) {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        const reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.onerror = function() {
        alert('No se pudo cargar el logo para el reporte. El PDF se generará sin logo.');
        callback('');
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}

// Becario
document.getElementById('btn-generar-reporte')?.addEventListener('click', function() {
    let modalidad = "{{ $n_actividad }}";
    let nombreUsuario = "{{ $user->role == 'user' ? ($user->becario->nombre . ' ' . $user->becario->apellido) : (($user->personal->nombre ?? 'Administrador') . ' ' . ($user->personal->apellido ?? '')) }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

    // Filtrar solo stats del usuario autenticado y modalidad actual
    const userId = {{ $user->id }};
    const rows = allStats
        .filter(stat => stat.becario && stat.becario.user_id === userId && stat.actividad === "{{ $modalidad }}")
        .map(stat => [
            stat.titulo,
            stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);

    toDataURL(logoUrl, function(logoBase64) {
        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.text('Reporte de ' + modalidad, doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Becario: ' + nombreUsuario, 10, 32);
        doc.text('Generado: ' + new Date().toLocaleString(), 10, 38);
        doc.setDrawColor(200, 200, 200);
        doc.line(10, 47, doc.internal.pageSize.getWidth() - 10, 47);

        const headers = [['Título', 'Tipo de Actividad', 'Fecha', 'Modalidad', 'Duración (Horas)', 'Estatus']];
        doc.autoTable({
            head: headers,
            body: rows,
            startY: 50,
            styles: { fontSize: 10 },
            headStyles: { fillColor: [30, 41, 59] },
            alternateRowStyles: { fillColor: [243, 244, 246] },
        });

        doc.save('Reporte_Actividades_' + nombreUsuario + '_' + new Date().toLocaleString() + '.pdf');
    });
});

// Admin
document.getElementById('btn-generar-reporte-admin')?.addEventListener('click', function() {
    let modalidad = "{{ $n_actividad }}";
    let nombreUsuario = "{{ $user->role == 'user' ? ($user->becario->nombre . ' ' . $user->becario->apellido) : (($user->personal->nombre ?? 'Administrador') . ' ' . ($user->personal->apellido ?? '')) }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

    // Filtrar solo stats de la modalidad actual y excluir anuladas
    const rows = allStats
        .filter(stat => stat.actividad === "{{ $modalidad }}" && stat.anulado !== 'SI')
        .map(stat => [
            (stat.becario?.nombre || '') + ' ' + (stat.becario?.apellido || ''),
            stat.titulo,
            stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);

    toDataURL(logoUrl, function(logoBase64) {
        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.text('Reporte general de ' + modalidad, doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Generado por: ' + nombreUsuario, 10, 32);
        doc.text('Generado: ' + new Date().toLocaleString(), 10, 38);
        doc.setDrawColor(200, 200, 200);
        doc.line(10, 47, doc.internal.pageSize.getWidth() - 10, 47);

        const headers = [['Becario', 'Título', 'Tipo de Actividad', 'Fecha', 'Modalidad', 'Duración (Horas)', 'Estatus']];
        doc.autoTable({
            head: headers,
            body: rows,
            startY: 50,
            styles: { fontSize: 10 },
            headStyles: { fillColor: [30, 41, 59] },
            alternateRowStyles: { fillColor: [243, 244, 246] },
        });

        doc.save('Reporte_General_Actividades_' + new Date().toLocaleString() + '.pdf');
    });
});
</script>

<!-- =========================
    ANIMACIÓN Y RESPONSIVE DEL FORMULARIO IZQUIERDA
========================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('toggle-form-btn');
    const btnIcon = document.getElementById('toggle-form-icon');
    const formDiv = document.getElementById('formulario-izquierda');
    const innerDiv = btn.parentElement;
    const tablaDiv = document.getElementById('tabla-derecha');

    function isDesktop() {
        return window.matchMedia('(min-width: 1280px)').matches;
    }

    // Leer el estado guardado en localStorage (por defecto false)
    let visible = localStorage.getItem('formularioIzquierdaVisible');
    visible = visible === null ? false : (visible === 'true');

    // Quitar transición temporalmente
    formDiv.classList.add('notransition');
    tablaDiv.classList.add('notransition');

    function setFormState(open) {
        if (open) {
            formDiv.classList.remove('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
            formDiv.classList.add('xl:w-1/4', 'w-full');
            tablaDiv.classList.remove('xl:w-[calc(100%-56px)]');
            tablaDiv.classList.add('xl:w-3/4');
            btnIcon.textContent = '⮜';
            Array.from(innerDiv.children).forEach(child => {
                child.style.display = '';
            });
            if (window.renderChart) {
                renderChart();
            }
        } else {
            formDiv.classList.remove('xl:w-1/4', 'w-full');
            formDiv.classList.add('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
            tablaDiv.classList.remove('xl:w-3/4');
            tablaDiv.classList.add('xl:w-[calc(100%-56px)]');
            btnIcon.textContent = '⮞';
            Array.from(innerDiv.children).forEach((child) => {
                if (child !== btn) child.style.display = 'none';
                else child.style.display = '';
            });
        }
    }

    // Aplica el estado SIN transición
    setFormState(visible);

    // Forzar reflow y quitar la clase notransition para que las siguientes veces sí haya animación
    setTimeout(() => {
        formDiv.classList.remove('notransition');
        tablaDiv.classList.remove('notransition');
    }, 10);

    tablaDiv.addEventListener('transitionend', function(e) {
        if (e.propertyName === 'width' && window.chart && typeof window.chart.resize === 'function') {
            window.chart.resize();
        }
    });

    window.addEventListener('resize', function() {
        if (!isDesktop()) {
            visible = true;
            setFormState(true);
        } else {
            setFormState(visible);
        }
    });

    btn.addEventListener('click', function() {
        if (!isDesktop()) return;
        visible = !visible;
        setFormState(visible);
        // Guardar el estado en localStorage
        localStorage.setItem('formularioIzquierdaVisible', visible);
    });
});
</script>

<!-- =========================
    ESTILOS PARA TRANSICIÓN
========================= -->
<style>
/* Quita la transición solo cuando tiene la clase notransition */
#formulario-izquierda.notransition,
#tabla-derecha.notransition {
    transition: none !important;
}
</style>
@endsection

