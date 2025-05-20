@extends('layouts.layout')

@section('titulo-tab')
Tabla de Estadísticas
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto py-10 px-0 md:px-10">

    <h1 class="text-2xl font-bold text-gray-800 text-center">Tabla de Actividades</h1>
    <h2 class="text-lg font-semibold text-gray-600 text-center">Aquí puedes agregar actividades y ver tus estadísticas
    </h2>
    <hr class="my-4">


    <div class="flex flex-wrap p-0 min-h-[650px]">
        <!-- Formulario para agregar actividad -->
        <div class="w-full xl:w-1/4 p-2 flex flex-col">
            <div class="flex flex-col bg-white border shadow-xl shadow-green-600 rounded-xl p-5 h-full">
                <h1 class="text-2xl font-bold text-center mb-4">Agregar Actividad</h1>

                <form action="{{ route('stat.store') }}" method="POST" novalidate class="flex flex-col flex-1">
                    @csrf
                    <div class="mb-4">
                        <div class="flex">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
                            @error('titulo')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="titulo"
                            class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('titulo') border-red-700 @enderror"
                            placeholder="Titulo de la Actividad" required value="{{ old('titulo') }}">
                    </div>

                    <div class="mb-4">
                        <div class="flex">
                            <label for="actividad"
                                class="block text-sm font-medium text-gray-700 mb-2">Actividad</label>
                            @error('actividad')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <select name="actividad"
                            class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('actividad') border-red-700 @enderror">
                            <option value="">Seleccione</option>
                            <option value="chat">Chat</option>
                            <option value="taller">Taller de Formación</option>
                            <option value="volin">Voluntariado Interno</option>
                            <option value="volex">Voluntariado Externo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <div class="flex">
                            <label for="modalidad"
                                class="block text-sm font-medium text-gray-700 mb-2">Modalidad</label>
                            @error('modalidad')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <select name="modalidad"
                            class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('modalidad') border-red-700 @enderror">
                            <option value="">Seleccione</option>
                            <option value="presencial">Presencial</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <div class="flex">
                            <label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
                            @error('duracion')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="duracion"
                            class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('duracion') border-red-700 @enderror"
                            placeholder="Ejemplo: 1.5" required value="{{ old('duracion') }}">
                    </div>

                    <div class="mb-4">
                        <div class="flex">
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
                            @error('fecha')
                            <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="date" name="fecha"
                            class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('fecha') border-red-700 @enderror"
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
        <div class="w-full xl:w-3/4 p-2 flex flex-col">
            <div class="flex flex-col bg-white border shadow-xl shadow-green-600 rounded-xl p-5 h-full">
                <div
                    class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                    <div>
                        <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                            class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5"
                            type="button">
                            <svg class="w-3 h-3 text-gray-500 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>
                            Ultimos 30 Días
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownRadio"
                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm"
                            style="position: absolute;">
                            <ul class="p-3 space-y-1 text-sm text-gray-700" aria-labelledby="dropdownRadioButton">
                                <li>
                                    <div class="flex items-center p-2 rounded-sm hover:bg-gray-100">
                                        <input id="filter-radio-example-1" type="radio" value="last_day"
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="filter-radio-example-1"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm">Ayer</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded-sm hover:bg-gray-100">
                                        <input checked id="filter-radio-example-2" type="radio" value="last_7_days"
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="filter-radio-example-2"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm">Ultimos 7
                                            días
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded-sm hover:bg-gray-100">
                                        <input id="filter-radio-example-3" type="radio" value="last_30_days"
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="filter-radio-example-3"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm">Ultimos 30
                                            días
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded-sm hover:bg-gray-100">
                                        <input id="filter-radio-example-4" type="radio" value="last_month"
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="filter-radio-example-4"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm">Mes pasado
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center p-2 rounded-sm hover:bg-gray-100">
                                        <input id="filter-radio-example-5" type="radio" value="last_year"
                                            name="filter-radio"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="filter-radio-example-5"
                                            class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm">Año pasado
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <label for="table-search" class="sr-only">Buscar</label>
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
                                <th scope="col" class="px-3 py-3">Titulo</th>
                                <th scope="col" class="px-3 py-3">Actividad</th>
                                <th scope="col" class="px-3 py-3">Modalidad</th>
                                <th scope="col" class="px-3 py-3">Horas</th>
                                <th scope="col" class="px-3 py-3">Fecha</th>
                                <th scope="col" class="px-3 py-3">Ver evidencias</th>
                                <th scope="col" class="px-3 py-3">Estatus</th>
                                <th scope="col" class="px-3 py-3">Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stats as $stat)
                            <tr
                                class="bg-white border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-300">
                                <td class="px-3 py-4">{{ $stat->titulo }}</td>
                                <td class="px-3 py-4">
                                    @switch($stat->actividad)
                                    @case('chat') Chat @break
                                    @case('taller') Taller de Formación @break
                                    @case('volin') Voluntariado Interno @break
                                    @case('volex') Voluntariado Externo @break
                                    @default {{ $stat->actividad }}
                                    @endswitch
                                </td>
                                <td class="px-3 py-4">
                                    @switch($stat->modalidad)
                                        @case('presencial') Presencial @break
                                        @case('Online') Online @break
                                        @default {{$stat->actividad}}
                                    @endswitch
                                </td>
                                <td class="px-3 py-4">{{ $stat->duracion }}</td>
                                <td class="px-3 py-4">{{ $stat->fecha }}</td>
                                <td class="px-3 py-4 text-center">
                                    <button
                                        class="bg-green-900 rounded p-2 text-white ver-evidencias-btn"
                                        data-evidencias='@json($stat->evidencias->pluck("ruta_imagen"))'
                                        type="button">
                                        Ver evidencias
                                    </button>
                                </td>
                                <td class="px-3 py-4">
                                    @if ($stat->estado == "pendiente")
                                        <span class="bg-yellow-300 p-2 text-bold rounded ">PENDIENTE</span>
                                    @elseif ($stat->estado == "rechazado")
                                        <span class="bg-red-300 p-2 text-bold rounded ">RECHAZADO</span>
                                    @else
                                        <span class="bg-green-300 p-2 text-bold rounded ">APROBADO</span>
                                    @endif
                                </td>
                                <td class="px-3 py-4">
                                 @if($stat->anulado == "NO")
                                    <button
                                        data-modal-target="popup-modal"
                                        data-modal-toggle="popup-modal"
                                        type="button"
                                        @if($stat->estado != "pendiente")
                                            disabled
                                            class="block text-white bg-red-700 opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @else
                                             class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @endif
                                    >
                                        Anular
                                    </button>
                                @elseif ($stat->anulado == "SI")
                                    <button
                                        data-modal-target="popup-modal-restaurar"
                                        data-modal-toggle="popup-modal-restaurar"
                                        type="button"
                                        @if($stat->estado != "pendiente")
                                            disabled
                                            class="block text-white bg-gray-700 opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @else
                                             class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @endif
                                    >
                                        Restaurar
                                    </button>

                                @endif
                                </td>

                            </tr>

                            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Cerrar</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">¿Estas seguro de que quieres anular esta actividad?</h3>
                                            <form action="{{ route('stat.anular', $stat) }}" method="POST">
                                            @csrf
                                                <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Si, estoy seguro.
                                                </button>
                                            </form>
                                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="popup-modal-restaurar" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Cerrar</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">¿Estas seguro de que quieres restaurar esta actividad?</h3>
                                            <form action="{{ route('stat.restaurar', $stat) }}" method="POST">
                                                @csrf
                                                <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Si, estoy seguro.
                                                </button>
                                            </form>

                                            <button data-modal-hide="popup-modal-restaurar" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancelar</button>
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
        </div>
        <button onclick="cerrarModalEvidencias()" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
        <div class="flex-1 flex items-center justify-center w-full">
            <div id="contenedor-evidencias" class="flex flex-wrap gap-2 justify-center items-center w-full"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Mostrar/ocultar dropdown (Flowbite style)
document.getElementById('dropdownRadioButton').addEventListener('click', function() {
    const dropdown = document.getElementById('dropdownRadio');
    dropdown.classList.toggle('hidden');
});


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



@endsection
