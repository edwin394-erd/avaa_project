@extends('layouts.layout')

@section('titulo-tab')
    Tabla de Eventos
@endsection

@section('contenido')

<div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-5">

    <div id="contenedor-principal" class="flex flex-wrap min-h-[calc(90vh-4rem)] xl:flex-nowrap p-0 h-full">
        <!-- Columna izquierda: Formulario -->
        <div class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0 order-1 xl:order-1 transition-all duration-500" id="formulario-izquierda">
            <div class="relative flex flex-col bg-white dark:bg-slate-900 border dark:border-gray-700 shadow-xl shadow-gray-100 dark:shadow-gray-900 rounded-l-xl p-4 h-full" id="form-content">
                 <button id="toggle-form-btn"
                    class="absolute top-2 right-2 z-20 px-2 py-1 bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 dark:bg-slate-700 dark:text-gray-100 dark:border-slate-700 dark:hover:bg-slate-800 rounded transition-all duration-300 hidden xl:block"
                    style="min-width:32px;min-height:32px;">
                    <span id="toggle-form-icon">⮜</span>
                  </button>
                <h1 class="text-lg 2xl:text-xl font-bold text-gray-700 dark:text-gray-100 text-center mb-4">Agregar Evento </h1>
                <hr class="mb-2 dark:border-slate-700">
               <form action="{{ route('activities.store') }}" method="POST" novalidate class="flex flex-col flex-1">
    @csrf
    <div class="mb-2">
        <div class="flex">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Título</label>
            @error('name')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <input type="text" name="name"
            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('name') border-red-700 @enderror"
            placeholder="Nombre del evento" required value="{{ old('name') }}">
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
            placeholder="Facilitador del evento" required value="{{ old('facilitador') }}">
    </div>
    <div class="mb-2">
        <div class="flex">
            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Duración (horas)</label>
            @error('duration')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <input type="number" name="duration" min="0" step="0.1"
            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('duration') border-red-700 @enderror"
            placeholder="Duración del evento" required value="{{ old('duration') }}">
    </div>
    <div class="mb-2">
        <div class="flex">
            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Lugar / Plataforma</label>
            @error('location')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <input type="text" name="location"
            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('location') border-red-700 @enderror"
            placeholder="Lugar del evento" required value="{{ old('location') }}">
    </div>
    <div class="mb-2">
        <div class="flex">
            <label for="actividad" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Actividad</label>
            @error('actividad')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <select name="actividad"
            class="text-sm shadow-sm rounded-md bg-white dark:bg-slate-800 w-full px-3 py-2 border-gray-300 dark:border-slate-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('actividad') border-red-700 @enderror">
            <option value="">Seleccione</option>
            <option value="volin" @selected(old('actividad')=='volin')>Voluntariado Interno</option>
            <option value="volex" @selected(old('actividad')=='volex')>Voluntariado Externo</option>
            <option value="chat" @selected(old('actividad')=='chat')>Chat</option>
            <option value="taller" @selected(old('actividad')=='taller')>Taller</option>
        </select>
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
            required value="{{ old('fecha') }}" min="{{ now()->toDateString() }}">
    </div>
    <div class="mb-2">
        <div class="flex">
            <label for="hora_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Hora de inicio</label>
            @error('hora_inicio')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <input type="time" name="hora_inicio"
            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('hora_inicio') border-red-700 @enderror"
            required value="{{ old('hora_inicio') }}">
    </div>
    <div class="mb-2 flex gap-2">
        <div class="w-1/2">
            <div class="flex">
                <label for="quorum_minimo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Quorum mínimo</label>
                @error('quorum_minimo')
                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                @enderror
            </div>
            <input type="number" name="quorum_minimo" min="0"
                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('quorum_minimo') border-red-700 @enderror"
                value="{{ old('quorum_minimo', 1) }}">
        </div>
        <div class="w-1/2">
            <div class="flex">
                <label for="quorum_maximo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Quorum máximo</label>
                @error('quorum_maximo')
                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                @enderror
            </div>
            <input type="number" name="quorum_maximo" min="0"
                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('quorum_maximo') border-red-700 @enderror"
                value="{{ old('quorum_maximo') }}">
        </div>
    </div>
    <button type="submit"
        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Agregar
    </button>
</form>
            </div>
        </div>
        <!-- Columna derecha: Tabla -->
        <div class="w-full xl:w-3/4 p-0 flex flex-col order-2 xl:order-2 transition-all duration-500" id="tabla-derecha">
            <div class="flex flex-col bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 shadow-xl shadow-gray-100 dark:shadow-slate-800 xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 gap-2">
                    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <button type="button" id="abrir-modal-filtrar-fecha"
                            class="inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 focus:ring-4 focus:ring-gray-100 dark:focus:ring-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 w-full sm:w-auto">
                            Filtrar por fecha
                        </button>
                        <a href="{{ route('activities.index') }}" id="btn-ver-todo"
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
                    <!-- Modal filtrar fecha -->
                    <div id="modal-filtrar-fecha"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
                            <h2 class="text-lg text-gray-700 dark:text-gray-100 font-bold mb-4 text-center">Filtrar actividades por fecha</h2>
                            <button type="button" id="cerrar-modal-filtrar-fecha"
                                class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                            <form method="GET" action="{{ route('activities.index') }}" class="flex flex-col gap-4" id="form-filtrar-fecha">
                                <div>
                                    <label for="fecha-inicio"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Fecha de inicio</label>
                                    <input type="date" id="fecha-inicio" name="fecha_inicio"
                                        class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100"
                                         required>
                                </div>
                                <div>
                                    <label for="fecha-fin" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Fecha de fin</label>
                                    <input type="date" id="fecha-fin" name="fecha_fin"
                                        class="w-full border border-gray-400 dark:border-slate-700 rounded px-3 py-2 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100"
                                        required>
                                </div>
                                <button type="submit"
                                    class="bg-slate-800 hover:bg-slate-700 text-white font-medium rounded px-4 py-2 mt-2">Aplicar filtro</button>
                            </form>
                        </div>
                    </div>
                    <!-- Buscador -->
                    <form method="GET" action="{{ route('activities.index') }}" class="flex items-center w-full sm:w-auto mt-2 sm:mt-0">
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
                    <table class="w-full text-sm text-left text-black dark:text-gray-100 table-auto bg-white dark:bg-slate-900">
                        <thead class="text-gray-700 dark:text-gray-200 text-md uppercase border-b border-gray-200 dark:border-slate-700">
                            <tr>
                                <th class="px-3 py-3">Nombre</th>
                                <th class="px-3 py-3">Facilitador</th>
                                <th class="px-3 py-3">Duración (Horas)</th>
                                <th class="px-3 py-3">Lugar/Plataforma</th>
                                <th class="px-3 py-3">Actividad</th>
                                <th class="px-3 py-3">Fecha/Hora</th>
                                <th class="px-3 py-3">Estatus</th>
                                <th class="px-3 py-3">Quorum</th>
                                <th class="px-3 py-3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $actividad)
                            <tr id="actividad-{{ $actividad->id }}"
                                class="@if(request('highlight') == $actividad->id) bg-yellow-200 dark:bg-yellow-700/40  @else bg-white h-20 dark:bg-slate-900 border-b border-gray-200 dark:border-gray-700 transition duration-300 ease-in-out hover:bg-blue-100 dark:hover:bg-blue-900/40 @endif">
                                <td class="px-3 py-2">{{ $actividad->name }}</td>
                                <td class="px-3 py-2">{{ $actividad->facilitador ? $actividad->facilitador : "No aplica"}}</td>
                                <td class="px-3 py-2">{{ $actividad->duration }}</td>
                                <td class="px-3 py-2">{{ $actividad->location }}</td>
                                @php
                                    $actividadTipo = [
                                        'volin' => ['label' => 'Vol. Interno', 'color' => 'bg-green-100 text-green-800 dark:bg-green-700/40 dark:text-green-200 whitespace-nowrap'],
                                        'volex' => ['label' => 'Vol. Externo', 'color' => 'bg-red-100 text-red-800 dark:bg-red-700/40 dark:text-red-200 whitespace-nowrap'],
                                        'taller' => ['label' => 'Taller', 'color' => 'bg-blue-100 text-blue-800 dark:bg-blue-700/40 dark:text-blue-200'],
                                        'chat' => ['label' => 'Chat', 'color' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700/40 dark:text-yellow-200'],
                                    ];
                                    $tipo = $actividadTipo[$actividad->actividad] ?? ['label' => ucfirst($actividad->actividad), 'color' => 'bg-gray-100 text-gray-800 dark:bg-gray-700/40 dark:text-gray-200'];
                                @endphp
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $tipo['color'] }}">
                                        {{ $tipo['label'] }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">{{ \Carbon\Carbon::parse($actividad->fecha)->format('d/m/Y') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $actividad->hora_inicio)->format('h:i A') }}</td>
                                <td class="px-3 py-2">
                                    @php
                                        $status = strtolower($actividad->status);
                                        $color = match($status) {
                                            'pendiente' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700/40 dark:text-yellow-200',
                                            'cancelada', 'anulada' => 'bg-red-100 text-red-800 dark:bg-red-700/40 dark:text-red-200',
                                            'completada', 'aprobada' => 'bg-green-100 text-green-800 dark:bg-green-700/40 dark:text-green-200',
                                            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700/40 dark:text-gray-200'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">
                                        {{ ucfirst($actividad->status) }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">
                                    @if(!is_null($actividad->quorum_minimo) && !is_null($actividad->quorum_maximo))
                                        {{ $actividad->quorum_minimo }} Mín - {{ $actividad->quorum_maximo }} Máx
                                    @elseif(!is_null($actividad->quorum_minimo))
                                        {{ $actividad->quorum_minimo }} Mín
                                    @elseif(!is_null($actividad->quorum_maximo))
                                        {{ $actividad->quorum_maximo }} Máx
                                    @else
                                        No definido
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <button class="text-blue-600 dark:text-blue-400 hover:underline mx-1"
                                    onclick="abrirModal('modal-editar-{{ $actividad->id }}')">Editar</button>
                                    @if(strtolower($actividad->status) === 'cancelada' || strtolower($actividad->status) === 'anulada')
                                        <button class="text-green-600 dark:text-green-400 hover:underline mx-1"
                                            onclick="abrirModal('modal-restaurar-{{ $actividad->id }}')">Restaurar</button>

                                        <!-- Modal RESTAURAR EVENTO -->
                                        <div id="modal-restaurar-{{ $actividad->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                            <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
                                                <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar restauración</h2>
                                                <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200">Evento: {{ $actividad->name }}</h2>
                                                <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200">Fecha: {{ \Carbon\Carbon::parse($actividad->date)->format('d/m/Y') }}</h2>
                                                <hr class="dark:border-slate-700"><br>
                                                <button type="button" onclick="cerrarModal('modal-restaurar-{{ $actividad->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                                                <div class="flex flex-col items-center">
                                                    <svg class="mx-auto mb-4 text-green-400 w-12 h-12" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-300 text-center">¿Estás seguro de que quieres restaurar este evento?</h3>
                                                    <hr class="dark:border-slate-700"><br>
                                                    <div class="text-center flex flex-row justify-center items-center gap-2">
                                                        <form action="{{ route('activities.restaurar', $actividad->id) }}" method="POST" class="flex items-center">
                                                            @csrf
                                                            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-medium rounded px-2 py-2 mt-2 mx-1">Sí, restaurar</button>
                                                        </form>
                                                        <button type="button" onclick="cerrarModal('modal-restaurar-{{ $actividad->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-1">No, cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button class="text-red-600 dark:text-red-400 hover:underline mx-1"
                                            onclick="abrirModal('modal-cancelar-{{ $actividad->id }}')">Cancelar</button>

                                        <!-- Modal CANCELAR EVENTO -->
                                        <div id="modal-cancelar-{{ $actividad->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                            <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
                                                <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Confirmar cancelación</h2>
                                                <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200">Evento: {{ $actividad->name }}</h2>
                                                <h2 class="text-sm mb-1 text-center text-gray-700 dark:text-gray-200">Fecha: {{ \Carbon\Carbon::parse($actividad->date)->format('d/m/Y') }}</h2>
                                                <hr class="dark:border-slate-700"><br>
                                                <button type="button" onclick="cerrarModal('modal-cancelar-{{ $actividad->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                                                <div class="flex flex-col items-center">
                                                    <svg class="mx-auto mb-4 text-red-400 w-12 h-12" aria-hidden="true" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-300 text-center">¿Estás seguro de que quieres cancelar este evento?</h3>
                                                    <hr class="dark:border-slate-700"><br>
                                                    <div class="text-center flex flex-row justify-center items-center gap-2">
                                                        <form action="{{ route('activities.cancelar', $actividad->id) }}" method="POST" class="flex items-center">
                                                            @csrf
                                                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-medium rounded px-2 py-2 mt-2 mx-1">Sí, cancelar</button>
                                                        </form>
                                                        <button type="button" onclick="cerrarModal('modal-cancelar-{{ $actividad->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 dark:text-gray-100 focus:outline-none bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700 hover:bg-gray-100 dark:hover:bg-slate-700 mx-1">No, cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif




                                   <!-- Modal EDITAR EVENTO -->
                                    <div id="modal-editar-{{ $actividad->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-md w-full relative">
                                            <h2 class="text-lg font-bold mb-4 text-center text-gray-800 dark:text-gray-100">Editar evento</h2><br>
                                            <button type="button" onclick="cerrarModal('modal-editar-{{ $actividad->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                                            <form action="{{ route('activities.update', $actividad->id) }}" method="POST" class="flex flex-col gap-2">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col md:flex-row md:space-x-2">
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="name" id="editar_name_{{ $actividad->id }}" value="{{ $actividad->name }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                                            <label for="editar_name_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Título</label>
                                                        </div>
                                                    </div>
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="facilitador" id="editar_facilitador_{{ $actividad->id }}" value="{{ $actividad->facilitador }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                                                            <label for="editar_facilitador_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Facilitador</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col md:flex-row md:space-x-2">
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="number" name="duration" id="editar_duration_{{ $actividad->id }}" value="{{ $actividad->duration }}" min="0" step="0.1" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                                            <label for="editar_duration_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Duración (horas)</label>
                                                        </div>
                                                    </div>
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="text" name="location" id="editar_location_{{ $actividad->id }}" value="{{ $actividad->location }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                                            <label for="editar_location_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Lugar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <select name="actividad" id="editar_actividad_{{ $actividad->id }}"
                                                        class="optionx block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        required>
                                                        <option class="bg-blue-100" value="" disabled selected hidden>Seleccione una opción</option>
                                                        <option class="bg-blue-100" value="volin" @selected($actividad->actividad=='volin')>Voluntariado Interno</option>
                                                        <option value="volex" @selected($actividad->actividad=='volex')>Voluntariado Externo</option>
                                                        <option value="chat" @selected($actividad->actividad=='chat')>Chat</option>
                                                        <option value="taller" @selected($actividad->actividad=='taller')>Taller</option>
                                                    </select>
                                                    <label for="editar_actividad_{{ $actividad->id }}"
                                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                        Actividad
                                                    </label>

                                                    <style>
                                                    /* Opciones del select en modo claro */
                                                    select option {
                                                        @apply text-slate-900 bg-white;
                                                    }
                                                    /* Opciones del select en modo oscuro */
                                                    @media (prefers-color-scheme: dark) {
                                                        #optionx, select option {
                                                            color: #f1f5f9 !important;      /* slate-100 */
                                                            background: #0f172a !important; /* slate-900 */
                                                        }
                                                    }
                                                    </style>
                                                </div>
                                                <div class="flex flex-col md:flex-row md:space-x-2">
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="date" name="fecha" id="editar_date_{{ $actividad->id }}" value="{{ $actividad->fecha }}" min="{{ now()->toDateString() }}"" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required >
                                                            <label for="editar_date_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fecha</label>
                                                        </div>
                                                    </div>
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="time" name="hora_inicio" id="editar_hora_inicio_{{ $actividad->id }}" value="{{ $actividad->hora_inicio }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                                            <label for="editar_hora_inicio_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hora de inicio</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col md:flex-row md:space-x-2">
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="number" name="quorum_minimo" id="editar_quorum_minimo_{{ $actividad->id }}" value="{{ $actividad->quorum_minimo }}" min="0" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                                                            <label for="editar_quorum_minimo_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quorum mínimo</label>
                                                        </div>
                                                    </div>
                                                    <div class="w-full md:w-1/2">
                                                        <div class="relative z-0 w-full mb-5 group">
                                                            <input type="number" name="quorum_maximo" id="editar_quorum_maximo_{{ $actividad->id }}" value="{{ $actividad->quorum_maximo }}" min="0" class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                                                            <label for="editar_quorum_maximo_{{ $actividad->id }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quorum máximo</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Guardar Cambios
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="p-10 text-center uppercase text-gray-500 dark:text-gray-400 align-middle">No hay eventos registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 flex flex-col items-center">
                    <div class="flex gap-1 mb-1">
                        @if ($activities->onFirstPage())
                            <button class="px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-400 rounded text-xs" disabled>&laquo;</button>
                        @else
                            <a href="{{ $activities->previousPageUrl() }}" class="px-2 py-1 bg-slate-800 text-white rounded text-xs hover:bg-slate-700">&laquo;</a>
                        @endif

                        <span class="px-2 py-1 text-xs text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-slate-800 rounded">
                            {{ $activities->currentPage() }}/{{ $activities->lastPage() }}
                        </span>

                        @if ($activities->hasMorePages())
                            <a href="{{ $activities->nextPageUrl() }}" class="px-2 py-1 bg-slate-800 text-white rounded text-xs hover:bg-slate-700">&raquo;</a>
                        @else
                            <button class="px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-400 rounded text-xs" disabled>&raquo;</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal filtrar fecha
    const abrirBtn = document.getElementById('abrir-modal-filtrar-fecha');
    const cerrarBtn = document.getElementById('cerrar-modal-filtrar-fecha');
    const modalFiltrar = document.getElementById('modal-filtrar-fecha');
    const formFiltrar = document.getElementById('form-filtrar-fecha');
    if (abrirBtn && modalFiltrar && formFiltrar) {
        abrirBtn.addEventListener('click', function() {
            modalFiltrar.style.display = 'flex';
            formFiltrar.reset();
            const hoy = new Date().toISOString().split('T')[0];
            document.getElementById('fecha-inicio').setAttribute('max', hoy);
            document.getElementById('fecha-fin').setAttribute('max', hoy);
        });
    }
    if (cerrarBtn && modalFiltrar) {
        cerrarBtn.addEventListener('click', function() {
            modalFiltrar.style.display = 'none';
        });
    }
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
<script>
function toDataURL(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.onerror = function() {
        callback(null);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}

let allEvents = [];
fetch("{{ route('events.all') }}")
    .then(res => res.json())
    .then(data => { allEvents = data; });

document.getElementById('btn-generar-reporte')?.addEventListener('click', generarReporte);
document.getElementById('btn-generar-reporte-admin')?.addEventListener('click', generarReporte);

function generarReporte() {
    let modalidad = "{{ $n_actividad ?? '' }}";
    let nombreUsuario = "{{ $user->role == 'user' ? $user->becario->nombre : ($user->personal->nombre ?? 'Administrador') }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

    toDataURL(logoUrl, function(logoBase64) {
        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.text('Reporte de Eventos', doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });
        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Generado por: ' + nombreUsuario, 10, 32);
        doc.text('Generado: ' + new Date().toLocaleString(), 10, 38);
        doc.setDrawColor(200, 200, 200);
        doc.line(10, 47, doc.internal.pageSize.getWidth() - 10, 47);

        const rows = allEvents.map(event => [
            event.name,
            event.facilitador ? event.facilitador : 'No aplica',
            (event.actividad === 'volin' ? 'Voluntariado Interno' :
             event.actividad === 'volex' ? 'Voluntariado Externo' :
             event.actividad === 'chat' ? 'Chat' :
             event.actividad === 'taller' ? 'Taller' :
             event.actividad),
            event.fecha && event.hora_inicio
                ? new Date(event.fecha + 'T' + event.hora_inicio).toLocaleDateString('es-VE') +
                  ' - ' +
                  (() => {
                      const [h, m] = event.hora_inicio.split(':');
                      let hour = parseInt(h, 10);
                      const ampm = hour >= 12 ? 'PM' : 'AM';
                      hour = hour % 12 || 12;
                      return `${hour}:${m} ${ampm}`;
                  })()
                : '',
            event.location,
            event.duration,

            event.status === 'pendiente' ? 'PENDIENTE' : (event.status === 'cancelada' ? 'CANCELADA' : (event.status === 'completada' ? 'COMPLETADA' : 'ERROR'))
        ]);
        const headers = [['Título', 'Facilitador', 'Tipo de Actividad', 'Fecha/Hora', 'Lugar/Plataforma', 'Duración (Horas)', 'Estatus']];
        doc.autoTable({
            head: headers,
            body: rows,
            startY: 50,
            styles: { font: 'helvetica', fontSize: 10 }
        });
        doc.save('reporte_eventos.pdf');
    });
}
</script>

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

function abrirModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    modal.style.opacity = 0;
    const content = modal.querySelector('div.bg-white, div.dark\\:bg-slate-900');
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
    const content = modal.querySelector('div.bg-white, div.dark\\:bg-slate-900');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
    }
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        if (content) {
            content.style.transform = '';
            content.style.opacity = '';
        }
    }, 200);
}
</script>
@endsection
