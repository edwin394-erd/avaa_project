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
                            <button type="button" id="cerrar-modal-filtrar-fecha" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
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
                                class="bg-white border-b border-gray-200 transition duration-300 ease-in-out hover:bg-gray-300">
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
                                        class="bg-green-900 rounded p-2 text-white ver-evidencias-btn"
                                        data-evidencias='@json($stat->evidencias->pluck("ruta_imagen"))'
                                        type="button">
                                        Ver evidencias
                                    </button>
                                </td>
                                <td class="px-3 py-4 text-center">
                                    @if ($stat->estado == "pendiente")
                                        <span class="bg-yellow-300 p-2 text-bold rounded ">PENDIENTE</span>
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
                                            class="block text-white bg-red-700 opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @else
                                             class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @endif
                                    >
                                        Anular
                                    </button>
                                @elseif ($stat->anulado == "SI")
                                    <button
                                        onclick="abrirModal('modal-restaurar-{{ $stat->id }}')"
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

                         <!-- Modal ANULAR -->
                        <div id="modal-anular-{{ $stat->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg p-6 max-w-sm w-full relative">
                                <h2 class="text-lg font-bold mb-4 text-center">Confirmar anulación</h2>
                                <hr><br><br>
                                <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
                                <div class="flex flex-col items-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">¿Estás seguro de que quieres anular esta actividad?</h3>
                                    <hr><br>
                                    <div>
                                     <form action="{{ route('stat.anular', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                                        @csrf
                                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white font-medium rounded px-4 py-2 mt-2 mx-3">
                                            Sí, estoy seguro
                                        </button>
                                    </form>
                                    <button type="button" onclick="cerrarModal('modal-anular-{{ $stat->id }}')" class="py-2.5 px-5 mt-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 mx-3">
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
                                <hr><br><br>
                                <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">&times;</button>
                                <div class="flex flex-col items-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">¿Estás seguro de que quieres restaurar esta actividad?</h3>
                                    <hr><br>
                                    <div>
                                        <form action="{{ route('stat.restaurar', $stat) }}" method="POST" class="w-full flex flex-col items-center">
                                        @csrf
                                            <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-medium rounded px-4 py-2 mt-2 mx-3">
                                                Sí, estoy seguro
                                            </button>
                                        </form>
                                        <button type="button" onclick="cerrarModal('modal-restaurar-{{ $stat->id }}')" class="py-2.5 px-5 mt-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 mx-3">
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
