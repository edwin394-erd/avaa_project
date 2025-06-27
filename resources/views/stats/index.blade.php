@extends('layouts.layout')

@section('titulo-tab')
    Tabla de Estadísticas
@endsection

@section('contenido')
@php
    $highlightId = request('highlight');
@endphp

<div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-5">
    <div id="contenedor-principal" class="flex flex-wrap min-h-[calc(90vh-4rem)] xl:flex-nowrap p-0 h-full">
         <!-- Columna izquierda -->
    @if ($user->role == 'admin')
        <div id="formulario-izquierda" class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0 order-1 xl:order-1 transition-all duration-500">
    @else
        <div id="formulario-izquierda" class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0 order-2 xl:order-1 transition-all duration-500">
    @endif
              <div class="relative flex flex-col bg-white dark:bg-slate-900 border dark:border-gray-700 shadow-xl shadow-gray-100 dark:shadow-gray-900 rounded-l-xl p-4 h-full">
                <button id="toggle-form-btn"
                    class="absolute top-2 right-2 z-20 px-2 py-1 bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 dark:bg-slate-700 dark:text-gray-100 dark:border-slate-700 dark:hover:bg-slate-800 rounded transition-all duration-300 hidden xl:block"
                    style="min-width:32px;min-height:32px;">
                    <span id="toggle-form-icon">⮜</span>
                </button>
                <div id="form-content" class="flex flex-col flex-1">
                    @if ($user->role == 'user')
                    <h1 class="text-lg 2xl:text-xl font-bold text-gray-700 dark:text-gray-100 text-center mb-4">Agregar Actividad</h1>
                    <hr class="mb-2 dark:border-slate-700">

                    <form action="{{ route('stat.store') }}" method="POST" novalidate class="flex flex-col flex-1">
                        @csrf
                        <div class="mb-2">
                            <div class="flex">
                                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Título</label>
                                @error('titulo')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="text" name="titulo"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('titulo') border-red-700 @enderror"
                                placeholder="Titulo de la Actividad" required value="{{ old('titulo') }}">
                        </div>
                        <div class="mb-2 flex flex-col md:flex-row gap-2">
                            <div class="flex-1">
                                <div class="flex">
                                    <label for="actividad" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Actividad</label>
                                    @error('actividad')
                                        <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                    @enderror
                                </div>
                                <select name="actividad"
                                    class="text-sm shadow-sm rounded-md bg-white dark:bg-slate-800 w-full px-3 py-2 border-gray-300 dark:border-slate-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('actividad') border-red-700 @enderror">
                                    <option value="">Seleccione</option>
                                    <option value="chat">Chat</option>
                                    <option value="taller">Taller de Formación</option>
                                    <option value="volin">Voluntariado Interno</option>
                                    <option value="volex">Voluntariado Externo</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <div class="flex">
                                    <label for="modalidad" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Modalidad</label>
                                    @error('modalidad')
                                        <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                    @enderror
                                </div>
                                <select name="modalidad"
                                    class="text-sm shadow-sm rounded-md bg-white dark:bg-slate-800 w-full px-3 py-2 border-gray-300 dark:border-slate-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('modalidad') border-red-700 @enderror">
                                    <option value="">Seleccione</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="flex">
                                <label for="duracion" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Duración</label>
                                @error('duracion')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="text" name="duracion"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('duracion') border-red-700 @enderror"
                                placeholder="Ejemplo: 1.5" required value="{{ old('duracion') }}" pattern="^\d*\.?\d*$"
                                inputmode="decimal"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="mb-2">
                            <div class="flex">
                                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Fecha</label>
                                @error('fecha')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="date" name="fecha"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('fecha') border-red-700 @enderror"
                                required value="{{ old('fecha') }}"
                                max="{{ now()->toDateString() }}">
                        </div>
                        <div class="mb-2">
                            <div class="flex">
                                <label for="facilitador" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Facilitador</label>
                                @error('facilitador')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="text" name="facilitador"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('facilitador') border-red-700 @enderror"
                                placeholder="Nombre del facilitador" value="{{ old('facilitador') }}">
                        </div>
                        <div class="mb-4">
                            <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </form>
                    <form action="{{ route('imagenes.store') }}" id="dropzone" enctype="multipart/form-data"
                        class="dropzone border-dashed border-2 border-slate-400 dark:border-slate-700 w-full h-4 rounded flex flex-col justify-center items-center mb-4 mt-auto"
                        method="POST">
                        @csrf
                    </form>
                    <button type="submit" onclick="enviarFormularios()"
                        class="mt-2 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Agregar
                    </button>
                @else
                {{-- si es admin --}}
                    <div class="flex flex-col gap-6 h-full justify-between">
                        @foreach ([
                            [
                                'title' => 'Voluntariado Interno',
                                'total' => $total_volin,
                                'meta' => $meta_volin,
                                'percentage' => $porcen_volin,
                                'color' => 'text-[#28a745]',
                                'bgcolor' => 'bg-[#e3f7e7] ',
                                'bgcolor2' => 'bg-[#218838] ', // más oscuro
                                'icono' => 'icon-volin.png',
                                'name' => 'volin',
                                'stats_realizado' => $stats_realizado_volin,
                            ],
                            [
                                'title' => 'Voluntariado Externo',
                                'total' => $total_volex,
                                'meta' => $meta_volex,
                                'percentage' => $porcen_volex,
                                'color' => 'text-[#dc3545]',
                                'bgcolor' => 'bg-[#f9e5e7]',
                                'bgcolor2' => 'bg-[#c82333]', // más oscuro
                                'icono' => 'icon-volex.png',
                                'name' => 'volex',
                                'stats_realizado' => $stats_realizado_volex,
                            ],
                            [
                                'title' => 'Chats',
                                'total' => $total_chat,
                                'meta' => $meta_chat,
                                'percentage' => $porcen_chat,
                                'color' => 'text-[#fd7e14]',
                                'bgcolor' => 'bg-[#fcf2ea]',
                                'bgcolor2' => 'bg-[#FD7E14]', // más oscuro
                                'icono' => 'icon-chat.png',
                                'name' => 'chat',
                                'stats_realizado' => $stats_realizado_chat,
                            ],
                            [
                                'title' => 'Talleres',
                                'total' => $total_taller,
                                'meta' => $meta_taller,
                                'percentage' => $porcen_taller,
                                'color' => 'text-[#007bff] ',
                                'bgcolor' => 'bg-[#e0eaff] ',
                                'bgcolor2' => 'bg-[#0056b3]', // más oscuro
                                'icono' => 'icon-taller.png',
                                'name' => 'taller',
                                'stats_realizado' => $stats_realizado_taller,
                            ],
                        ] as $modalidad)
                        @php
                            $totalRealizadas = $modalidad['stats_realizado']->count();
                            $totalHoras =   $modalidad['stats_realizado']->sum('duracion');
                            $meta = $modalidad['meta'];
                            $icono = $modalidad['icono'];
                            $porcentaje = $meta > 0 ? min(100, round(($totalHoras / $meta) * 100)) : 0;
                            $bgcolor2 = $modalidad['bgcolor2'];
                            $color = $modalidad['color'];
                            $n_actividad = $modalidad['title'];
                        @endphp
                        <div>
                            <div class="flex items-center space-x-3 xl:mb-3 text-center">
                                <img src="{{ asset('imgs/' . $icono)}}" alt="icono" class="w-10 h-10 3xl:w-12 3xl:h-12">
                                <h1 class="test-md 2xl:text-lg 3xl:text-xl font-bold {{ $color }} mb-0 flex items-center"> {{ $n_actividad }}</h1>
                            </div>
                            <div class="flex flex-col gap-0.5 2xl:gap-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-300 text-sm">Total actividades realizadas:</span>
                                    <span class="font-bold text-md 2xl:text-lg dark:text-gray-100">{{ $totalRealizadas }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 dark:text-gray-300 text-sm">Total horas realizadas:</span>
                                    <span class="font-bold text-md 2xl:text-lg dark:text-gray-100">{{ $totalHoras }}h</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-4 overflow-hidden mt-2">
                                    <div class="h-4 rounded-full {{ $bgcolor2 }} transition-all duration-700 ease-in-out barra-progreso"
                                        style="width: 0%" data-porcentaje="{{ $porcentaje }}"></div>
                                </div>
                                <div class="text-right text-xs text-gray-700 dark:text-gray-300 mt-1">
                                    Progreso: <span class="font-semibold">{{ $porcentaje }}%</span> /
                                    <span>Meta: {{ $meta }} horas</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
                </div>

        </div>
           <!-- Columna derecha -->
        @if ($user->role == 'admin')
            <div id="tabla-derecha" class="w-full xl:w-3/4 p-0 flex flex-col order-2 xl:order-2 transition-all duration-500">
        @else
            <div id="tabla-derecha" class="w-full xl:w-3/4 p-0 flex flex-col order-1 xl:order-2 transition-all duration-500">
        @endif
            <div class="flex flex-col bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700  xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 gap-2">
                    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <button type="button" id="abrir-modal-filtrar-fecha"
                            class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 focus:ring-4 focus:ring-gray-100 dark:focus:ring-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                            Filtrar por fecha
                        </button>
                        <a href="{{ route('stats.index') }}" id="btn-ver-todo"
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
                            <form method="GET" action="{{ route('stats.index') }}" class="flex flex-col gap-4">
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
                    <form method="GET" action="{{ route('stats.index') }}" class="flex items-center w-full sm:w-auto mt-2 sm:mt-0">
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
                    <table class="w-full text-sm text-left rtl:text-right text-black   <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-100 table-auto bg-white dark:bg-slate-900" id="myTable">
                        <thead class="text-gray-700 dark:text-gray-200 text-md uppercase border-b border-gray-200 dark:border-slate-700">
                            <tr>
                                @if ($user->role == 'admin')
                                    <th class="px-3 py-3 text-left">BECARIO</th>
                                @endif
                                <th scope="col" class="px-3 py-3 text-left">Titulo</th>
                                <th scope="col" class="px-3 py-3 text-left">Actividad</th>
                                <th scope="col" class="px-3 py-3 text-left">Facilitador</th>
                                
                                <th scope="col" class="px-3 py-3 text-left">Fecha</th>
                                <th scope="col" class="px-3 py-3 text-left">Modalidad</th>
                                <th scope="col" class="px-3 py-3 text-left">Duración (Horas)</th>
                                <th scope="col" class="px-3 py-3 text-left">Ver evidencias</th>
                                <th scope="col" class="px-3 py-3 text-left">Estatus</th>
                                <th scope="col" class="px-3 py-3"> Opciones</th>
                            </tr>
                        </thead>
                           <tbody>
@forelse ($stats as $stat)
<tr
    id="stat-{{ $stat->id }}"
    class="text-sm border-b border-gray-200 dark:border-slate-700 transition duration-300 ease-in-out align-middle
            @if((string)$highlightId === (string)$stat->id)
                    bg-yellow-200 dark:bg-yellow-700/40 hover:bg-yellow-100 dark:hover:bg-yellow-800/60
            @else
                    bg-white dark:bg-slate-900 hover:bg-blue-100 dark:hover:bg-blue-900/40
            @endif"
    style="height: 20px;"
>
        @if ($user->role == 'admin')
            <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-left gap-2">
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
        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">{{ $stat->titulo }}</td>
        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">
            @switch($stat->actividad)
                @case('chat') Chat @break
                @case('taller') Taller de Formación @break
                @case('volin') Voluntariado Interno @break
                @case('volex') Voluntariado Externo @break
                @default {{ $stat->actividad }}
            @endswitch
        </td>
        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">{{ $stat->facilitador ?? "No Aplica" }}</td>

        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">
            {{ \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') }}
        </td>
        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">
            @switch($stat->modalidad)
                @case('presencial') Presencial @break
                @case('online') Online @break
                @default {{ $stat->modalidad }}
            @endswitch
        </td>
        <td class="px-3 py-4 text-left text-gray-900 dark:text-gray-100">{{ $stat->duracion }}</td>
        <td class="px-3 py-4 text-left">
            <button class="rounded p-2 text-white bg-white ver-evidencias-btn hover:bg-blue-100 dark:bg-transparent"
                data-evidencias='@json($stat->evidencias->pluck('ruta_imagen'))' type="button">
                <svg width="30px" height="30px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000">
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
        <td class="px-3 py-4 text-left">
            @if ($stat->anulado == 'SI')
                <span class="bg-gray-300 dark:bg-gray-700 p-2 text-bold rounded text-gray-900 dark:text-gray-100">ANULADO</span>
            @elseif ($stat->estado == 'pendiente')
                <span class="bg-yellow-200 dark:bg-yellow-700 p-2 text-bold rounded text-gray-900 dark:text-gray-100">PENDIENTE</span>
            @elseif ($stat->estado == 'rechazado')
                <span class="bg-red-300 dark:bg-red-700 p-2 text-bold rounded cursor-pointer text-gray-900 dark:text-gray-100"
                    onclick="abrirModal('modal-motivo-rechazo-{{ $stat->id }}')" title="Ver motivo de rechazo">
                    RECHAZADO
                </span>
            @else
                <span class="bg-green-200 dark:bg-green-700 p-2 text-bold rounded text-gray-900 dark:text-gray-100">APROBADO</span>
            @endif
        </td>
        <td class="px-3 py-4 text-left flex">
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

                  <!-- Botón Editar -->
                    <button 
                        onclick="abrirModal('modal-editar-{{ $stat->id }}')" 
                        class="block text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center  ml-1
                            @if($stat->estado == 'aprobado' || $stat->estado == 'rechazado') opacity-50 cursor-not-allowed @endif"
                        title="Editar actividad"
                        @if($stat->estado == 'aprobado' || $stat->estado == 'rechazado') disabled @endif
                    >
                    <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="edit-icon-svg"
                    >
                        <g>
                            <path d="M15 20.47H6.08C5.17469 20.4673 4.30737 20.1059 3.66815 19.4648C3.02894 18.8237 2.66999 17.9553 2.67 17.05V8.15999C2.66999 7.25468 3.02894 6.3863 3.66815 5.74521C4.30737 5.10413 5.17469 4.74264 6.08 4.73999H8.75C8.94891 4.73999 9.13968 4.81901 9.28033 4.95966C9.42098 5.10031 9.5 5.29108 9.5 5.48999C9.5 5.6889 9.42098 5.87967 9.28033 6.02032C9.13968 6.16097 8.94891 6.23999 8.75 6.23999H6.08C5.57252 6.24263 5.08672 6.44608 4.72881 6.80587C4.3709 7.16565 4.16999 7.6525 4.17 8.15999V17.05C4.16603 17.3038 4.21243 17.5559 4.30651 17.7916C4.4006 18.0274 4.5405 18.2422 4.71812 18.4235C4.89575 18.6049 5.10757 18.7492 5.34133 18.8481C5.57509 18.9471 5.82616 18.9987 6.08 19H15C15.2521 19 15.5018 18.9503 15.7348 18.8538C15.9677 18.7574 16.1794 18.6159 16.3576 18.4376C16.5359 18.2593 16.6774 18.0477 16.7738 17.8147C16.8703 17.5818 16.92 17.3321 16.92 17.08V15.27C16.92 15.0711 16.999 14.8803 17.1397 14.7397C17.2803 14.599 17.4711 14.52 17.67 14.52C17.8689 14.52 18.0597 14.599 18.2003 14.7397C18.341 14.8803 18.42 15.0711 18.42 15.27V17.05C18.42 17.4991 18.3315 17.9438 18.1597 18.3588C17.9878 18.7737 17.7359 19.1507 17.4183 19.4683C17.1007 19.7859 16.7237 20.0378 16.3088 20.2097C15.8938 20.3815 15.4491 20.47 15 20.47Z"/>
                            <path d="M17.63 8.76999C17.4369 8.76772 17.2519 8.69203 17.1126 8.5583C16.9733 8.42457 16.8901 8.24283 16.88 8.04999C16.8649 7.74758 16.7771 7.45328 16.6239 7.19212C16.4706 6.93096 16.2566 6.71067 16 6.54999C15.7209 6.37187 15.4006 6.26856 15.07 6.24999C14.9715 6.24671 14.8746 6.22406 14.7849 6.18333C14.6951 6.14261 14.6143 6.08461 14.547 6.01264C14.4797 5.94068 14.4272 5.85616 14.3925 5.7639C14.3579 5.67165 14.3417 5.57348 14.345 5.47499C14.3483 5.3765 14.3709 5.27962 14.4116 5.18988C14.4524 5.10014 14.5104 5.0193 14.5823 4.95198C14.6543 4.88466 14.7388 4.83217 14.8311 4.79751C14.9233 4.76285 15.0215 4.74671 15.12 4.74999C15.9727 4.78201 16.7819 5.1344 17.3862 5.73683C17.9905 6.33926 18.3454 7.14742 18.38 7.99999C18.384 8.0985 18.3686 8.19684 18.3345 8.28937C18.3005 8.38191 18.2486 8.46683 18.1817 8.53927C18.1148 8.61172 18.0343 8.67027 17.9448 8.71158C17.8553 8.75288 17.7585 8.77613 17.66 8.77999L17.63 8.76999Z"/>
                            <path d="M13 13.36H10.53C10.3311 13.36 10.1403 13.281 9.99967 13.1403C9.85902 12.9997 9.78 12.8089 9.78 12.61V10.09C9.78017 9.89115 9.85931 9.70051 10 9.56L15 4.56C15.0689 4.48924 15.1514 4.433 15.2424 4.39461C15.3334 4.35621 15.4312 4.33643 15.53 4.33643C15.6288 4.33643 15.7266 4.35621 15.8176 4.39461C15.9086 4.433 15.9911 4.48924 16.06 4.56L16.92 5.42C16.9946 5.49425 17.0528 5.58337 17.0907 5.68158C17.1286 5.77978 17.1454 5.88487 17.14 5.99C17.2451 5.98523 17.35 6.00233 17.4481 6.04019C17.5462 6.07806 17.6354 6.13588 17.71 6.21L18.58 7.07C18.7204 7.21062 18.7993 7.40124 18.7993 7.6C18.7993 7.79875 18.7204 7.98937 18.58 8.13L13.58 13.13C13.504 13.2057 13.4134 13.2651 13.3137 13.3047C13.214 13.3442 13.1072 13.363 13 13.36ZM11.24 11.86H12.69L17 7.57L16.66 7.24C16.5869 7.16468 16.5297 7.07538 16.4919 6.97743C16.4541 6.87949 16.4364 6.77492 16.44 6.67C16.3349 6.67538 16.2298 6.65857 16.1316 6.62067C16.0334 6.58277 15.9442 6.52461 15.87 6.45L15.54 6.12L11.28 10.4L11.24 11.86Z"/>
                            <path d="M18.08 8.31999C17.8811 8.31982 17.6905 8.24069 17.55 8.1L16.68 7.24C16.6069 7.16468 16.5497 7.07538 16.5119 6.97743C16.4741 6.87949 16.4564 6.77492 16.46 6.67C16.3549 6.67538 16.2498 6.65857 16.1516 6.62067C16.0534 6.58277 15.9642 6.52461 15.89 6.45L15 5.59C14.8595 5.44937 14.7807 5.25875 14.7807 5.05999C14.7807 4.86124 14.8595 4.67062 15 4.53L17.55 1.99999C17.6906 1.85954 17.8812 1.78065 18.08 1.78065C18.2787 1.78065 18.4694 1.85954 18.61 1.99999L21.11 4.51C21.1808 4.57894 21.237 4.66136 21.2754 4.75238C21.3138 4.84341 21.3336 4.9412 21.3336 5.03999C21.3336 5.13879 21.3138 5.23658 21.2754 5.32761C21.237 5.41863 21.1808 5.50105 21.11 5.57L18.61 8.1C18.4695 8.24069 18.2788 8.31982 18.08 8.31999ZM17.21 6C17.3088 5.99777 17.4069 6.01618 17.4982 6.05406C17.5895 6.09195 17.6718 6.14846 17.74 6.21999L18.08 6.55L19.52 5.09999L18.08 3.60999L16.62 5.05999L16.95 5.38999C17.0246 5.46425 17.0828 5.55337 17.1207 5.65158C17.1586 5.74978 17.1754 5.85487 17.17 5.96L17.21 6Z"/>
                        </g>
                        <style>
                            .edit-icon-svg path {
                                fill: #facc15; /* amarillo por defecto */
                            }
                            html.dark .edit-icon-svg path {
                                fill: #fff !important; /* blanco en dark */
                            }
                        </style>
                    </svg>
                    </button>

                    <!-- Modal Editar -->
                    <div id="modal-editar-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-lg w-full relative">
                            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Editar Actividad</h2>
                            <button type="button" onclick="cerrarModal('modal-editar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                            <form action="{{ route("stats.update", $stat->id) }}" method="POST" class="flex flex-col gap-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="titulo-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Título</label>
                                    <input type="text" id="titulo-{{ $stat->id }}" name="titulo" value="{{ $stat->titulo }}" class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100" required>
                                </div>
                                 <div class="mb-2 flex flex-col md:flex-row gap-2">
                            <div class="flex-1">
                                <div class="flex">
                                    <label for="actividad-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Actividad</label>
                                    @error('actividad')
                                        <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                    @enderror
                                </div>
                                <select name="actividad" id="actividad-{{ $stat->id }}"
                                    class="text-sm shadow-sm rounded-md bg-white dark:bg-slate-800 w-full px-3 py-2 border-gray-300 dark:border-slate-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('actividad') border-red-700 @enderror">
                                    <option value="">Seleccione</option>
                                    <option value="chat" {{ $stat->actividad == 'chat' ? 'selected' : '' }}>Chat</option>
                                    <option value="taller" {{ $stat->actividad == 'taller' ? 'selected' : '' }}>Taller de Formación</option>
                                    <option value="volin" {{ $stat->actividad == 'volin' ? 'selected' : '' }}>Voluntariado Interno</option>
                                    <option value="volex" {{ $stat->actividad == 'volex' ? 'selected' : '' }}>Voluntariado Externo</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <div class="flex">
                                    <label for="modalidad-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Modalidad</label>
                                    @error('modalidad')
                                        <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                    @enderror
                                </div>
                                <select name="modalidad" id="modalidad-{{ $stat->id }}"
                                    class="text-sm shadow-sm rounded-md bg-white dark:bg-slate-800 w-full px-3 py-2 border-gray-300 dark:border-slate-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('modalidad') border-red-700 @enderror">
                                    <option value="">Seleccione</option>
                                    <option value="presencial" {{ $stat->modalidad == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="online" {{ $stat->modalidad == 'online' ? 'selected' : '' }}>Online</option>
                                </select>
                            </div>
                        </div>
                                <div>
                                    <label for="facilitador-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Facilitador</label>
                                    <input type="text" id="facilitador-{{ $stat->id }}" name="facilitador" value="{{ $stat->facilitador }}" class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100">
                                </div>
                                <div>
                                    <label for="fecha-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Fecha</label>
                                    <input type="date" id="fecha-{{ $stat->id }}" name="fecha" value="{{ $stat->fecha }}" class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100" required>
                                </div>
                                <div>
                                    <label for="duracion-{{ $stat->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Duración (horas)</label>
                                    <input type="number" id="duracion-{{ $stat->id }}" name="duracion" value="{{ $stat->duracion }}" min="1" step="0.1" class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100" required>
                                </div>
                                <div class="flex justify-center gap-2 mt-4">
                                    <button type="submit" class="bg-slate-800 hover:bg-slate-900
                                    dark:hover:bg-slate-700 text-white font-medium rounded px-4 py-2">Guardar cambios</button>

                                    <button type="button" onclick="cerrarModal('modal-editar-{{ $stat->id }}')" class="py-2 px-4 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-medium rounded px-2 py-2 mt-2 mx-1">Sí, estoy seguro</button>
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
                    <div class="text-center flex justify-center gap-2">
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-medium rounded px-2 py-2 mt-2 mx-1">Sí, estoy seguro</button>
                        <button type="button" onclick="cerrarModal('modal-rechazar-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-3">No, cancelar</button>
                    </div>
                </form>
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
</tbody>
</table>
</div>
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
</div>

            </div>
        </div>
        </div>
        </div>


    @endsection

    @section('scripts')
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
                         formDiv.classList.remove('notransition');
                            tablaDiv.classList.remove('notransition');
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



{{-- REPORTE PDF BECARIO Y ADMIN --}}
<script>
let allStats = [];
let filteredStats = [];
let isAdmin = @json($user->role === 'admin');

// Cargar todos los registros al cargar la página
fetch("{{ route('stats.all') }}")
    .then(res => res.json())
    .then(data => {
        allStats = data;
        filteredStats = data;
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
    let modalidad = "{{ $n_actividad ?? '' }}";
    let nombreUsuario = "{{ $user->role == 'user' ? ($user->becario->nombre . ' ' . $user->becario->apellido) : (($user->personal->nombre ?? 'Administrador') . ' ' . ($user->personal->apellido ?? '')) }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

    // Filtrar solo stats del usuario autenticado
    const userId = {{ $user->id }};
    const rows = allStats
        .filter(stat => stat.becario && stat.becario.user_id === userId)
        .map(stat => [
            stat.titulo,
             stat.actividad === 'chat' ? 'Chat'
            : stat.actividad === 'taller' ? 'Taller de Formación'
            : stat.actividad === 'volin' ? 'Voluntariado Interno'
            : stat.actividad === 'volex' ? 'Voluntariado Externo'
            : stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);

    toDataURL(logoUrl, function(logoBase64) {
        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');

        doc.text('Reporte de Actividades', doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });
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

        const pdfUrl = doc.output('bloburl');
        window.open(pdfUrl, '_blank');


    });
});

// Admin
document.getElementById('btn-generar-reporte-admin')?.addEventListener('click', function() {
    let modalidad = "{{ $n_actividad ?? '' }}";
    let nombreUsuario = "{{ $user->role == 'user' ? $user->becario->nombre : ($user->personal->nombre ?? 'Administrador') }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

    // Todas las stats, excluyendo las anuladas
    const rows = allStats
        .filter(stat => stat.anulado !== 'SI')
        .map(stat => [
            (stat.becario?.nombre || '') + ' ' + (stat.becario?.apellido || ''),
            stat.titulo,
            stat.actividad === 'chat' ? 'Chat'
            : stat.actividad === 'taller' ? 'Taller de Formación'
            : stat.actividad === 'volin' ? 'Voluntariado Interno'
            : stat.actividad === 'volex' ? 'Voluntariado Externo'
            : stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);

    toDataURL(logoUrl, function(logoBase64) {
        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');

        doc.text('Reporte general de Actividades', doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });
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

         const pdfUrl = doc.output('bloburl');
        window.open(pdfUrl, '_blank');
    });
});
</script>

        <script>
      document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.barra-progreso').forEach(barra => {
                const porcentaje = barra.dataset.porcentaje || '0';
                barra.style.transition = 'none';
                barra.style.width = '0%';
                barra.offsetHeight; // trigger reflow
                setTimeout(() => {
                    barra.style.transition = 'width 1s cubic-bezier(0.4,0,0.2,1)';
                    barra.style.width = porcentaje + '%';
                }, 100);
            });
        });
        </script>
        @if(request('highlight'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const row = document.getElementById('stat-{{ request('highlight') }}');
                if(row) {
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>
        @endif

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
    let visible;
    if (window.matchMedia('(max-width: 639px)').matches) {
        // sm o menor: siempre visible
        visible = true;
    } else {
        // md en adelante: usa localStorage
        visible = localStorage.getItem('formularioIzquierdaVisible');
        visible = visible === null ? false : (visible === 'true');
    }

    // Quitar transición temporalmente
    formDiv.classList.add('notransition');
    tablaDiv.classList.add('notransition');

   const formContent = document.getElementById('form-content');

function setFormState(open) {
    if (open) {
        formDiv.classList.remove('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
        formDiv.classList.add('xl:w-1/4', 'w-full');
        tablaDiv.classList.remove('xl:w-[calc(100%-56px)]');
        tablaDiv.classList.add('xl:w-3/4');
        btnIcon.textContent = '⮜';
        if (formContent) formContent.style.display = '';
    } else {
        formDiv.classList.remove('xl:w-1/4', 'w-full');
        formDiv.classList.add('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
        tablaDiv.classList.remove('xl:w-3/4');
        tablaDiv.classList.add('xl:w-[calc(100%-56px)]');
        btnIcon.textContent = '⮞';
        if (formContent) formContent.style.display = 'none';
    }
}

    // Aplica el estado SIN transición
    setFormState(visible);

    // Forzar reflow y quitar la clase notransition para que las siguientes veces sí haya animación
    setTimeout(() => {
        formDiv.classList.remove('notransition');
        tablaDiv.classList.remove('notransition');
    }, 10);

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
            // ESTO ES UN ERROR:
            // formDiv.classList.remove('notransition');
            // tablaDiv.classList.remove('notransition');
            modal.style.opacity = 1;
            if (content) {
                content.style.transform = 'scale(1)';
                content.style.opacity = 1;
            }
        }, 10);
    });
});
        </script>
    @endsection
