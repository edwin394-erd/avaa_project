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
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Descripción</label>
            @error('description')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
            @enderror
        </div>
        <input type="text" name="description"
            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('description') border-red-700 @enderror"
            placeholder="Descripción del evento" required value="{{ old('description') }}">
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
            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Lugar</label>
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
            required value="{{ old('fecha') }}" max="{{ now()->toDateString() }}">
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
                value="{{ old('quorum_minimo', 0) }}">
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
                    <!-- Modal filtrar fecha -->
                    <div id="modal-filtrar-fecha"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg p-6 max-w-sm w-full relative">
                            <h2 class="text-lg text-gray-700 dark:text-gray-100 font-bold mb-4 text-center">Filtrar actividades por fecha</h2>
                            <button type="button" id="cerrar-modal-filtrar-fecha"
                                class="absolute top-2 right-2 text-gray-500 hover:text-black dark:hover:text-white text-lg 2xl:text-2xl">&times;</button>
                            <form method="GET" action="{{ route('stats.index') }}" class="flex flex-col gap-4" id="form-filtrar-fecha">
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
                    <table class="w-full text-sm text-left text-black dark:text-gray-100 table-auto bg-white dark:bg-slate-900">
                        <thead class="text-gray-700 dark:text-gray-200 text-md uppercase border-b border-gray-200 dark:border-slate-700">
                            <tr>
                                <th class="px-3 py-3">Nombre</th>
                                <th class="px-3 py-3">Descripción</th>
                                <th class="px-3 py-3">Duración</th>
                                <th class="px-3 py-3">Lugar</th>
                                <th class="px-3 py-3">Actividad</th>
                                <th class="px-3 py-3">Fecha</th>
                                <th class="px-3 py-3">Hora inicio</th>
                                <th class="px-3 py-3">Estatus</th>
                                <th class="px-3 py-3">Quorum min</th>
                                <th class="px-3 py-3">Quorum max</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $actividad)
                            <tr id="actividad-{{ $actividad->id }}"
                                class="@if(request('highlight') == $actividad->id) bg-yellow-200 dark:bg-yellow-700/40 @else bg-white dark:bg-slate-900 @endif">
                                <td class="px-3 py-2">{{ $actividad->name }}</td>
                                <td class="px-3 py-2">{{ $actividad->description }}</td>
                                <td class="px-3 py-2">{{ $actividad->duration }}</td>
                                <td class="px-3 py-2">{{ $actividad->location }}</td>
                                <td class="px-3 py-2">{{ ucfirst($actividad->actividad) }}</td>
                                <td class="px-3 py-2">{{ \Carbon\Carbon::parse($actividad->date)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2">{{ $actividad->hora_inicio }}</td>
                                <td class="px-3 py-2">{{ ucfirst($actividad->status) }}</td>
                                <td class="px-3 py-2">{{ $actividad->quorum_minimo }}</td>
                                <td class="px-3 py-2">{{ $actividad->quorum_maximo }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="p-10 text-center uppercase text-gray-500 dark:text-gray-400 align-middle">No hay eventos registrados</td>
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
let allStats = [];
fetch("{{ route('stats.all') }}")
    .then(res => res.json())
    .then(data => { allStats = data; });

document.getElementById('btn-generar-reporte')?.addEventListener('click', function() {
    let modalidad = "{{ $n_actividad ?? '' }}";
    let nombreUsuario = "{{ $user->role == 'user' ? $user->becario->nombre : ($user->personal->nombre ?? 'Administrador') }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

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

        const rows = allStats.map(stat => [
            stat.titulo,
            stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);
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

document.getElementById('btn-generar-reporte-admin')?.addEventListener('click', function() {
    let modalidad = "{{ $n_actividad ?? '' }}";
    let nombreUsuario = "{{ $user->role == 'user' ? $user->becario->nombre : ($user->personal->nombre ?? 'Administrador') }}";
    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

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

        const rows = allStats.map(stat => [
            stat.user?.becario?.nombre || '',
            stat.titulo,
            stat.actividad,
            stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
            stat.modalidad,
            stat.duracion,
            stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
        ]);
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
</script>
@endsection
