@extends('layouts.layout')

@section('titulo-tab')
Tabla de Estadísticas
@endsection

@section('contenido')
<div class="2xl:w-5/6 mx-auto py-5 px-0 md:px-10">

    <h1 class="text-lg 2xl:text-2xl font-bold text-gray-800 text-center">Tabla de Actividades</h1>
    <h2 class="text-md 2xl:text-lg font-semibold text-gray-600 text-center">Aquí puedes agregar actividades y ver tus estadísticas</h2>
    <hr class="my-4">


    <div class="flex flex-wrap p-0 min-h-[650px]">
        <!-- Formulario para agregar actividad -->
        <div class="w-full xl:w-1/4 p-0 flex flex-col">
            <div class="flex flex-col bg-white border shadow-xl shadow-gray-100 rounded-l-xl p-4 h-full">
                <h1 class="text-lg 2xl:text-2xl font-bold text-gray-700 text-center mb-4">Agregar Actividad</h1>

                <form action="{{ route('stat.store') }}" method="POST" novalidate class="flex flex-col flex-1">
                    @csrf
                    <div class="mb-2">
                        <div class="flex">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                            @error('titulo')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="titulo"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('titulo') border-red-700 @enderror"
                            placeholder="Titulo de la Actividad" required value="{{ old('titulo') }}">
                    </div>

                    <div class="mb-2">
                        <div class="flex">
                            <label for="actividad"
                                class="block text-sm font-medium text-gray-700 mb-2">Actividad</label>
                            @error('actividad')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <select name="actividad"
                            class="text-sm shadow-sm rounded-md bg-white w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('actividad') border-red-700 @enderror">
                            <option value="">Seleccione</option>
                            <option value="chat">Chat</option>
                            <option value="taller">Taller de Formación</option>
                            <option value="volin">Voluntariado Interno</option>
                            <option value="volex">Voluntariado Externo</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <div class="flex">
                            <label for="modalidad"
                                class="block text-sm font-medium text-gray-700 mb-2">Modalidad</label>
                            @error('modalidad')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <select name="modalidad"
                            class="text-sm shadow-sm rounded-md bg-white w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('modalidad') border-red-700 @enderror">
                            <option value="">Seleccione</option>
                            <option value="presencial">Presencial</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <div class="flex">
                            <label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
                            @error('duracion')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="duracion"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('duracion') border-red-700 @enderror"
                            placeholder="Ejemplo: 1.5" required value="{{ old('duracion') }}">
                    </div>

                    <div class="mb-2">
                        <div class="flex">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                            @error('fecha')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="date" name="fecha"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('fecha') border-red-700 @enderror"
                            required value="{{ old('fecha') }}">
                    </div>

                    <div class="mb-4">
                        <input type="hidden" name="imagen" value="{{old('imagen')}}">
                    </div>



                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                </form>
                 <form action="{{route('imagenes.store')}}" id="dropzone" enctype="multipart/form-data"
                            class="dropzone border-dashed border-2 border-black w-full h-4 rounded flex flex-col justify-center items-center mb-4"
                            method="POST">
                            @csrf
                            @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            @enderror
                </form>

                <button type="submit" onclick="enviarFormularios()"
                        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">{{ __('Agregar') }}
                </button>

            </div>
        </div>

        <!-- Tabla de estadísticas -->
        <div class="w-full xl:w-3/4 p-0 flex flex-col">
            <div class="flex flex-col bg-white border shadow-xl shadow-gray-100 xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                        <div>
                             {{-- filtrar por fecha --}}
                        <button
                            type="button"
                            id="abrir-modal-filtrar-fecha"
                            class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                            onclick="document.getElementById('modal-filtrar-fecha').classList.remove('hidden')"
                        >
                            Filtrar por fecha
                        </button>

                        <button
                            type="button"
                            id="btn-ver-todo"
                            class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 ml-2"
                        >
                            Ver todo
                        </button>
                        </div>


                        <div id="modal-filtrar-fecha" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg p-6 max-w-sm w-full relative">
                            <h2 class="text-lg font-bold mb-4 text-center">Filtrar actividades por fecha</h2>
                            <button type="button" id="cerrar-modal-filtrar-fecha" class="absolute top-2 right-2 text-gray-500 hover:text-black text-lg 2xl:text-2xl">&times;</button>
                            <form id="form-filtrar-fecha" class="flex flex-col gap-4">
                                <div>
                                    <label for="fecha-inicio" class="block text-sm font-medium text-gray-700 mb-1">Fecha de inicio</label>
                                    <input type="date" id="fecha-inicio" name="fecha_inicio" class="w-full border rounded px-3 py-2" max="{{ now()->toDateString() }}" required>
                                </div>
                                <div>
                                    <label for="fecha-fin" class="block text-sm font-medium text-gray-700 mb-1">Fecha de fin</label>
                                    <input type="date" id="fecha-fin" name="fecha_fin" class="w-full border rounded px-3 py-2" max="{{ now()->toDateString() }}" required>
                                </div>
                                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-medium rounded px-4 py-2 mt-2">Aplicar filtro</button>
                            </form>

                    </div>

                    </div>

                    <label for="table-search" class="sr-only text-sm">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar">
                    </div>
                </div>

                <div class="overflow-y-auto h-[580px]">
                    <table class="w-full text-sm text-left rtl:text-right text-black table-auto bg-white" id="myTable">
                        <thead class="text-green-700 text-md uppercase border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-3 py-3 text-center">Titulo</th>
                                <th scope="col" class="px-3 py-3 text-center">Actividad</th>
                                <th scope="col" class="px-3 py-3 text-center">Modalidad</th>
                                <th scope="col" class="px-3 py-3 text-center">Horas</th>
                                <th scope="col" class="px-3 py-3 text-center">Fecha</th>
                                <th scope="col" class="px-3 py-3 text-center">Ver evidencias</th>
                                <th scope="col" class="px-3 py-3 text-center">Estatus</th>
                                <th scope="col" class="px-3 py-3 "> Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats as $stat)
                            <tr
                                class="bg-white text-sm border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-100 text-sm">
                                <td class="px-3 py-4 text-center" text-center>{{ $stat->titulo }}</td>
                                <td class="px-3 py-4 text-center">
                                    @switch($stat->actividad)
                                    @case('chat') Chat @break
                                    @case('taller') Taller de Formación @break
                                    @case('volin') Voluntariado Interno @break
                                    @case('volex') Voluntariado Externo @break
                                    @default {{ $stat->actividad }}
                                    @endswitch
                                </td>
                                <td class="px-3 py-4 text-center">
                                    @switch($stat->modalidad)
                                        @case('presencial') Presencial @break
                                        @case('Online') Online @break
                                        @default {{$stat->actividad}}
                                    @endswitch
                                </td>
                                <td class="px-3 py-4 text-center">{{ $stat->duracion }}</td>
                                <td class="px-3 py-4 text-center">{{ $stat->fecha }}</td>
                                <td class="px-3 py-4 text-center">
                                   
                                    <button
                                        class=" rounded p-2 text-white ver-evidencias-btn "
                                        data-evidencias='@json($stat->evidencias->pluck("ruta_imagen"))'
                                        type="button">
                                        <svg width="30px" height="30px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <defs>
                                                    <style>
                                                        .a {
                                                            fill: none;
                                                            stroke: hsl(200, 68%, 21%);
                                                            stroke-linecap: round;
                                                            stroke-linejoin: round;
                                                            stroke-width: 3.5; /* Aumenta el grosor aquí */
                                                        }
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
                                    
                                    @if($stat->anulado == "SI")
                                     <span class="bg-gray-300 p-2 text-bold rounded ">ANULADO</span>
                                    @elseif ($stat->estado == "pendiente")
                                        <span class="bg-yellow-200 p-2 text-bold rounded ">PENDIENTE</span>
                                    @elseif ($stat->estado == "rechazado")
                                        <span class="bg-red-300 p-2 text-bold rounded ">RECHAZADO</span>
                                    @else
                                        <span class="bg-green-300 p-2 text-bold rounded ">APROBADO</span>
                                    @endif
                                </td>
                                <td class="px-3 py-4 text-center">
                                 @if($stat->anulado == "NO")
                                    <button
                                        onclick="abrirModal('modal-anular-{{ $stat->id }}')"
                                        @if($stat->estado != "pendiente")
                                            disabled
                                            class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @else
                                             class="block text-white  focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @endif
                                    >
                                        <svg width="30px" height="30px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#e00000" stroke="#e00000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;stroke:#ad1212;stroke-miterlimit:10;stroke-width:1.91px;}</style></defs><circle class="cls-1" cx="12" cy="12" r="10.5"></circle><line class="cls-1" x1="19.64" y1="4.36" x2="4.36" y2="19.64"></line></g></svg>
                                    </button>
                                @elseif ($stat->anulado == "SI")
                                    <button
                                        onclick="abrirModal('modal-restaurar-{{ $stat->id }}')"
                                        @if($stat->estado != "pendiente")
                                            disabled
                                            class="block text-white opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center -translate-x-0.5"
                                        @else
                                             class="block text-white focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center -translate-x-0.5"
                                        @endif
                                    >
                                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                        width="35px" height="35px" viewBox="0 0 900.000000 900.000000"
                                        preserveAspectRatio="xMidYMid meet">
                                        <metadata>
                                        Created by potrace 1.10, written by Peter Selinger 2001-2011
                                        </metadata>
                                        <g transform="translate(0.000000,900.000000) scale(0.100000,-0.100000)"
                                        fill="#000000" stroke="none">
                                        <path d="M4440 7915 c-25 -13 -54 -29 -65 -34 -11 -6 -27 -15 -35 -21 -22 -15
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
                                        91 -11 258 0 139 -3 261 -6 273 -4 17 -52 56 -66 53 -1 0 -23 -11 -48 -24z"/>
                                        </g>
                                        </svg>

                                    </button>

                                @endif
                                </td>

                            </tr>

                         <!-- Modal ANULAR -->
                        <div id="modal-anular-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg p-6 max-w-sm w-full relative">
                                <h2 class="text-lg font-bold mb-4 text-center">Confirmar anulación</h2>
                                <h2 class="text-sm mb-4 text-center"> Actividad: {{$stat->titulo}} ({{ $stat->fecha }})</h2>
                                <hr><br><br>
                                <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-lg 2xl:text-2xl">&times;</button>
                                <div class="flex flex-col items-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 text-center">¿Estás seguro de que quieres anular esta actividad?</h3>
                                    <hr><br>
                                    <div class="text-center">
                                     <form action="{{ route('stat.anular', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                                        @csrf
                                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">
                                            Sí, estoy seguro
                                        </button>
                                    </form>
                                    <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 mx-3">
                                        No, cancelar
                                    </button>
                                </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal RESTAURAR -->
                        <div id="modal-restaurar-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg p-6 max-w-sm w-full relative">
                                <h2 class="text-lg font-bold mb-4 text-center">Confirmar restauración</h2>
                                 <h2 class="text-sm mb-4 text-center"> Actividad: {{$stat->titulo}} ({{ $stat->fecha }})</h2>
                                <hr><br><br>
                                <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-lg 2xl:text-2xl">&times;</button>
                                <div class="flex flex-col items-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 text-center">¿Estás seguro de que quieres restaurar esta actividad?</h3>
                                    <hr><br>
                                    <div class="text-center">
                                        <form action="{{ route('stat.restaurar', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                                        @csrf
                                            <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-medium rounded px-2 py-2 mt-2 mx-3">
                                                Sí, estoy seguro
                                            </button>
                                        </form>
                                        <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="py-2 px-2 mt-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 mx-3">
                                            No, cancelar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                            </div>
                            @empty
                            <tr>
                                <td colspan="8" class="p-10 text-center uppercase text-gray-500 align-middle">No tienes
                                    estadísticas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-4">
                    <p class="text-sm text-gray-700 text-center mt-2">Mostrando
                        {{ $stats->lastItem() }} de {{ $stats->total() }} resultados
                        (Página
                        {{ $stats->currentPage() }} de {{ $stats->lastPage() }})</p>
                    <br>
                    <p class="text-sm text-gray-700">
                        {{ $stats->links('pagination::tailwind') }}
                    </p>

                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal para evidencias -->
<div id="modal-evidencias" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full relative min-h-96 flex flex-col items-center">
        <div class="w-full text-center">
            <h2 class="text-lg font-bold mb-4">Evidencias</h2>
             <h2 class="text-sm mb-4 text-center"> Actividad: {{$stat->titulo}} ({{ $stat->fecha }})</h2>
        </div>
        <button onclick="cerrarModalEvidencias()" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
        <div class="flex-1 flex items-center justify-center w-full">
            <div id="contenedor-evidencias" class="flex flex-wrap gap-2 justify-center items-center w-full"></div>
        </div>
    </div>
</div>

<!-- Modal para imagen ampliada -->
<div id="modal-img-ampliada" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[9999] hidden">
    <img id="img-ampliada" src="" alt="Evidencia ampliada" class="max-h-[90vh] max-w-[90vw] rounded shadow-lg border-4 border-white">
    <button onclick="cerrarModalImgAmpliada()" class="absolute top-4 right-6 text-white text-4xl font-bold">&times;</button>
</div>
@endsection

@section('scripts')
<script>


document.getElementById('table-search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const rows = document.querySelectorAll('#myTable tbody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let found = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(search)) {
                found = true;
            }
        });
        row.style.display = found ? '' : 'none';
    });
});

// Enviar ambos formularios con el btn_enviar
function enviarFormularios() {
    document.querySelector('form[action="{{ route('stat.store') }}"]').submit();
}

// Mostrar evidencias en el modal
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
        document.getElementById('modal-evidencias').classList.remove('hidden');
    });
});

function cerrarModalEvidencias() {
    document.getElementById('modal-evidencias').classList.add('hidden');
}
</script>
<script>
const abrirBtn = document.getElementById('abrir-modal-filtrar-fecha');
if (abrirBtn) {
    abrirBtn.addEventListener('click', function() {
        document.getElementById('modal-filtrar-fecha').classList.remove('hidden');
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
            document.getElementById('modal-filtrar-fecha').classList.add('hidden');
        });
    }
});
document.getElementById('form-filtrar-fecha').addEventListener('submit', function(e) {
    e.preventDefault();
    const inicio = document.getElementById('fecha-inicio').value;
    const fin = document.getElementById('fecha-fin').value;
    if (!inicio || !fin || inicio > fin) {
        alert('Selecciona un rango de fechas válido.');
        return;
    }
    // Filtrar filas de la tabla
    const rows = document.querySelectorAll('#myTable tbody tr');
    rows.forEach(row => {
        const fechaTd = row.querySelector('td:nth-child(5)');
        if (!fechaTd) return;
        const fecha = fechaTd.textContent.trim();
        if (fecha >= inicio && fecha <= fin) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    document.getElementById('modal-filtrar-fecha').classList.add('hidden');
});
</script>

<script>
function abrirModal(id) {
    document.getElementById(id).style.display = 'flex';
}
function cerrarModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Mostrar imagen ampliada al hacer click
document.getElementById('contenedor-evidencias').addEventListener('click', function(e) {
    if (e.target.tagName === 'IMG') {
        document.getElementById('img-ampliada').src = e.target.src;
        document.getElementById('modal-img-ampliada').classList.remove('hidden');
    }
});

function cerrarModalImgAmpliada() {
    document.getElementById('modal-img-ampliada').classList.add('hidden');
    document.getElementById('img-ampliada').src = '';
}

document.getElementById('modal-img-ampliada').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModalImgAmpliada();
    }
});
</script>

 <script>
document.getElementById('btn-ver-todo').addEventListener('click', function() {
    // Mostrar todas las filas de la tabla
    document.querySelectorAll('#myTable tbody tr').forEach(row => {
        row.style.display = '';
    });
    // Limpiar el filtro de búsqueda
    document.getElementById('table-search').value = '';
});
</script>

@endsection