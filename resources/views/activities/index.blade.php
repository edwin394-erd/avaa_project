@extends('layouts.layout')

@section('titulo-tab')
    Actividades Proximas
@endsection

@section('contenido')
    <div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-10">
        <h1 class="text-2xl font-bold dark:text-white mb-5 text-center">Actividades Proximas</h1>
        <div class="md:flex md:flex-wrap -mx-2">
            @forelse ($activities as $actividad)
                @if (($actividad->status === 'pendiente' or $actividad->status === 'cancelada') && \Carbon\Carbon::parse($actividad->fecha)->gte(\Carbon\Carbon::today()))
                    <div class="flex flex-col md:w-2/4 lg:w-1/3 mb-4 px-2">
                        <div class="card shadow-lg bg-white dark:bg-slate-900 border shadow-lg shadow-gray-300 dark:shadow-slate-800 border-gray-200 dark:border-slate-700 rounded-xl hover:shadow-xl transition-shadow duration-300">
                        
                            <div class="flex w-4/4 py-5 relative">
                                <!-- Número de votos en la esquina superior derecha -->
                                <div class="absolute top-2 right-2 flex flex-col items-end space-y-1">
                                    <button class="text-green-600 text-xs font-bold px-3 py-1 rounded-full shadow border border-green-600"  onclick="abrirModal('modal-votos-{{ $actividad->id }}', 'modal-votos-content-{{ $actividad->id }}')">
                                        {{ $asistencias->where('event_id', $actividad->id)->count() ?? 0 }} {{ $actividad->quorum_minimo ? "/".$actividad->quorum_minimo. " Votos" : 'Votos' }}
                                    </button>
                                  
                                    <!-- Modal de votos -->
                                    <div id="modal-votos-{{ $actividad->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden transition-opacity duration-200">
                                        <div id="modal-votos-content-{{ $actividad->id }}"
                                            class="bg-white dark:bg-slate-900 rounded-xl shadow-lg w-full max-w-md p-6 transform scale-95 opacity-0 transition-all duration-200"
                                            style="transition-property: opacity, transform;">
                                            <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Votos para "{{ $actividad->name }}"</h2>
                                            <ul class="mb-6 max-h-60 overflow-y-auto text-gray-700 dark:text-gray-200">
                                                @forelse($asistencias->where('event_id', $actividad->id) as $asistencia)
                                                    <li class="py-2 dark:border-slate-700">
                                                        {{ $asistencia->becario->nombre ?  $asistencia->becario->nombre . " " .  $asistencia->becario->apellido : 'Usuario desconocido' }}
                                                    </li>
                                                @empty
                                                    <li>No hay votos registrados.</li>
                                                @endforelse
                                            </ul>
                                            <div class="flex justify-end">
                                                <button type="button"
                                                    class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-slate-600 transition-colors"
                                                    onclick="cerrarModal('modal-votos-{{ $actividad->id }}', 'modal-votos-content-{{ $actividad->id }}')">
                                                    Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body w-2/5 flex items-center justify-center px-6">
                                    <img src="{{ $actividad->flyer ? asset("/storage/" . $actividad->flyer) : asset('imgs/flyer1.jpg') }}"
                                         alt="Flyer de {{ $actividad->name }}"
                                         class="h-48 w-full object-cover rounded-lg shadow-md border border-gray-200 dark:border-slate-700 transition-transform duration-200 hover:scale-105"
                                         onclick="abrirModal('modal-flyer-{{ $actividad->id }}', 'modal-flyer-content-{{ $actividad->id }}')">
                                </div>

                                <!-- Modal del flyer -->
                                <div id="modal-flyer-{{ $actividad->id }}" class="fixed
                                    inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden transition-opacity duration-200">
                                    <div id="modal-flyer-content-{{ $actividad->id }}"
                                         class="bg-white dark:bg-slate-900 rounded-xl shadow-lg w-full max-w-md p-6 transform scale-95 opacity-0 transition-all duration-200"
                                         style="transition-property: opacity, transform;">
                                        <img src="{{ $actividad->flyer ? asset("/storage/" . $actividad->flyer) : asset('imgs/flyer1.jpg') }}"
                                             alt="Flyer de {{ $actividad->name }}"
                                             class="w-full h-auto rounded-lg">
                                        <button type="button"
                                                class="mt-4 px-4 py-2 rounded-lg bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-slate-600 transition-colors"
                                                onclick="cerrarModal('modal-flyer-{{ $actividad->id }}', 'modal-flyer-content-{{ $actividad->id }}')">
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body w-3/5 justify-right px-2 py-2">
                                    <p class="text-gray-900 dark:text-white mb-2 font-extrabold text-xl leading-tight truncate">{{ $actividad->name }}</p>
                                    <div class="space-y-1 text-sm">
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Facilitador:</span> {{ $actividad->facilitador ?? "No aplica"}}</p>
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Duración:</span> {{ $actividad->duration }} horas</p>
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Fecha:</span> {{ $actividad->fecha }}</p>
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Hora:</span> {{ \Carbon\Carbon::parse($actividad->hora_inicio)->format('h:i A') }}</p>
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Quorum Max:</span> {{ $actividad->quorum_maximo ?? "Ilimitado" }}</p>
                                        @php
                                            $tipos = [
                                                'volin' => ['label' => 'Vol. Interno', 'color' => 'text-green-600'],
                                                'volex' => ['label' => 'Vol. Externo', 'color' => 'text-red-600'],
                                                'taller' => ['label' => 'Taller', 'color' => 'text-blue-600'],
                                                'chat' => ['label' => 'Chat', 'color' => 'text-yellow-500'],
                                            ];
                                            $tipo = $tipos[$actividad->actividad] ?? ['label' => $actividad->actividad, 'color' => 'text-gray-700 dark:text-gray-200'];
                                        @endphp
                                        <p class="text-gray-700 dark:text-gray-200">
                                            <span class="font-semibold"></span>
                                            <span class="{{ $tipo['color'] }} font-bold">{{ $tipo['label'] }}</span>
                                        </p>
                                        <p class="text-gray-700 dark:text-gray-200"><span class="font-semibold">Estado:</span>
                                            <span class="inline-block px-2 py-0.5 rounded-full
                                                @if($actividad->status === 'pendiente')
                                                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @elseif($actividad->status === 'completada')
                                                    bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($actividad->status === 'cancelada')
                                                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                @endif
                                            ">
                                                {{ $actividad->status }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @if (auth()->user()->role !== 'admin')
                            <div class="flex justify-center">
                                @php
                                    $yaRegistrado = $asistencias->where('event_id', $actividad->id)
                                        ->where('becario_id', auth()->user()->becario->id)
                                        ->count() > 0;
                                @endphp
                                @if ($yaRegistrado)
                                    <!-- Botón para abrir el modal -->
                                    <div class="w-1/2 mt-auto mb-4">
                                        <button type="button"
                                            class="w-full py-2 rounded-lg bg-slate-700 hover:bg-c-600 text-red-600 bg-slate-100 font-semibold dark:bg-slate-800 dark:hover:bg-slate-700 transition-colors text-center"
                                            onclick="abrirModal('modal-cancelar-{{ $actividad->id }}', 'modal-content-{{ $actividad->id }}')">
                                            Cancelar asistencia
                                        </button>
                                    </div>
            
                                   

                                    <!-- Modal de confirmación con animación -->
                                    <div id="modal-cancelar-{{ $actividad->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden transition-opacity duration-200">
                                        <div id="modal-content-{{ $actividad->id }}"
                                            class="bg-white dark:bg-slate-900 rounded-xl shadow-lg w-full max-w-md p-6 transform scale-95 opacity-0 transition-all duration-200"
                                            style="transition-property: opacity, transform;">
                                            <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Confirmar cancelación</h2>
                                            <p class="mb-6 text-gray-700 dark:text-gray-200">¿Seguro que deseas cancelar tu asistencia a <span class="font-semibold">{{ $actividad->name }}</span>?</p>
                                            <div class="flex justify-end gap-3">
                                                <button type="button"
                                                    class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-slate-600 transition-colors"
                                                    onclick="cerrarModal('modal-cancelar-{{ $actividad->id }}', 'modal-content-{{ $actividad->id }}')">
                                                    No, volver
                                                </button>
                                                <form method="POST" action="{{ route('activities.asistencia.cancelar', ['event' => $actividad->id, 'becario' => auth()->user()->becario->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors">
                                                        Sí, cancelar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('activities.asistencia', ['event' => $actividad->id, 'becario' => auth()->user()->becario->id]) }}" class="w-1/2 mt-auto">
                                        @csrf
                                        <button type="submit" class="w-full py-2 rounded-lg bg-slate-700 hover:bg-c-600 text-white dark:bg-slate-800 dark:hover:bg-slate-700 transition-colors text-center">
                                            Asistiré
                                        </button>
                                    </form>
                                @endif
                            </div>

                        @else
                        <div class="flex justify-center">
                                @if($actividad->status === 'cancelada')
                                    <form method="POST" action="{{ route('activities.restaurar', ['id' => $actividad->id]) }}" class="w-1/2 mt-auto">
                                        @csrf
                                        <button type="submit" class="w-full py-2 rounded-lg bg-slate-300/10 hover:bg-slate-400/10 text-green-600 transition-colors text-center">
                                            Restaurar
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('activities.cancelar', ['id' => $actividad->id]) }}" class="w-1/2 mt-auto">
                                        @csrf
                                        <button type="submit" class="w-full py-2 rounded-lg bg-slate-300/10 hover:bg-slate-400/10 text-red-600 transition-colors text-center">
                                            Cancelar
                                        </button>
                                    </form>
                                @endif
                            </div>

                     
                        
                        @endif

                        </div>
                               
                    </div>
                @endif
             @empty
                <div class="w-full text-center text-gray-500 dark:text-gray-400">
                    <p>No hay actividades próximas disponibles.</p>
                </div>   
            @endforelse
        </div>
    </div>
@endsection


@section('scripts')
<script>
    // Funciones genéricas para abrir/cerrar modales con animación
    function abrirModal(modalId, contentId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(contentId);
        modal.classList.remove('hidden');
        setTimeout(() => content.classList.remove('scale-95','opacity-0'), 10);
    }
    function cerrarModal(modalId, contentId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(contentId);
        content.classList.add('scale-95','opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    // Cerrar modal al hacer click fuera del contenido
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id^="modal-cancelar-"], [id^="modal-votos-"]').forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    // Busca el primer hijo div (el contenido del modal)
                    const content = modal.querySelector('div');
                    cerrarModal(modal.id, content.id);
                }
            });
        });
    });
</script>