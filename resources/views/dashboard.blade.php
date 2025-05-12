@extends('layouts.layout')

@section('titulo-tab')
  Inicio
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto p-10 min-h-full">
  <h1 class="text-2xl font-bold text-gray-800 text-center">Bienvenido, {{$nombre_becario}}</h1>
  <h2 class="text-lg font-semibold text-gray-600 text-center">Aquí tienes un resumen de tu progreso</h2>
  <hr class="my-4">
  <br>

   <!-- Tarjetas de progreso -->
   <div class="flex flex-wrap p-2">
    @foreach ([
      ['title' => 'Voluntariado Interno', 'total' => $total_volin, 'meta' => $meta_volin, 'percentage' => $porcen_volin],
      ['title' => 'Voluntariado Externo', 'total' => $total_volex, 'meta' => $meta_volex, 'percentage' => $porcen_volex],
      ['title' => 'Talleres', 'total' => $total_taller, 'meta' => $meta_taller, 'percentage' => $porcen_taller],
      ['title' => 'Chat', 'total' => $total_chat, 'meta' => $meta_chat, 'percentage' => $porcen_chat],
    ] as $card)
      <div class="w-full sm:w-2/4 2xl:w-1/4 p-2">
        <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl">
          <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800">{{ $card['title'] }}</h3>
            <hr><br>
            <div class="flex">
              <div class="w-2/5">
                <div class="relative size-24 md:size-28">
                  <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-gray-200" stroke-width="2"></circle>
                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-green-600" stroke-width="2" stroke-dasharray="100" stroke-dashoffset="{{ 100 - $card['percentage'] }}" stroke-linecap="round"></circle>
                  </svg>
                  <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <span class="text-center text-xl font-bold text-green-600">{{ $card['percentage'] }}%</span>
                  </div>
                </div>
              </div>
              <div class="w-3/5">
                <h1 class="text-right text-2xl lg:text-3xl">{{ $card['total'] }} horas</h1>
                <h2 class="text-right text-lg lg:text-xl">Meta: {{ $card['meta'] }} horas</h2>
                <h2 class="text-right text-lg lg:text-xl text-yellow-900">Restante: {{ $card['meta'] - $card['total'] }} horas</h2>
              </div>
            </div>
            <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-green-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
              Ver detalle
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <!-- Fin de las tarjetas de progreso -->

  <div class="flex flex-wrap p-2">
    
    <div class="w-full md:w-4/4 2xl:w-2/4 p-2">
      <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl">
          <div class="p-4 md:p-5">
              <h3 class="text-lg font-bold text-gray-800">Progreso General</h3>
              <hr>
              <br>
              <div class="flex">
              <div class="w-3/5">
               <div class="max-w-sm w-full bg-white rounded-lg shadow-sm p-6">
  <h3 class="text-xl font-semibold text-gray-800 mb-4">Estadísticas de Becarios</h3>
  <div class="space-y-4">
    <!-- Gráfico de Ingresos -->
    <div>
      <h4 class="text-sm font-semibold text-gray-600">Ingresos</h4>
      <div class="relative">
        <svg width="100%" height="50">
          <rect width="70%" height="100%" fill="currentColor" class="text-blue-500"></rect>
        </svg>
        <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white font-semibold">70%</span>
      </div>
    </div>
    <!-- Gráfico de Gastos -->
    <div>
      <h4 class="text-sm font-semibold text-gray-600">Gastos</h4>
      <div class="relative">
        <svg width="100%" height="50">
          <rect width="50%" height="100%" fill="currentColor" class="text-red-500"></rect>
        </svg>
        <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white font-semibold">50%</span>
      </div>
    </div>
  </div>
</div>

              </div>
              <div class="w-2/5">
                <h1 class="text-right text-2xl lg:text-3xl">{{ $horas_totales }} horas</h1>
                <h2 class="text-right text-lg lg:text-xl">Meta: {{ $meta_total }} horas</h2>
                <h2 class="text-right text-lg lg:text-xl text-yellow-900">Restante: {{ $meta_total - $horas_totales }} horas</h2>
              </div>
            </div>
          </div>
      </div>
  </div>

   <div class="w-full md:w-4/4 2xl:w-2/4 p-2">
    <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl">
        <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800">Actividades Próximas</h3>
            <hr>
            <br>

            <!-- Lista de actividades -->
            <div class="space-y-4">
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    <div class="flex flex-col">
                        <h4 class="font-semibold text-lg text-gray-800">Voluntariado Externo</h4>
                        <p class="text-sm text-gray-600">Actividad de voluntariado en el evento de limpieza del parque.</p>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm text-gray-500">Fecha: 15 Nov, 2023</span>
                        <span class="block text-sm text-yellow-600 mt-1">Pendiente</span>
                    </div>
                </div>

                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    <div class="flex flex-col">
                        <h4 class="font-semibold text-lg text-gray-800">Taller de Liderazgo</h4>
                        <p class="text-sm text-gray-600">Taller sobre habilidades de liderazgo para jóvenes en la comunidad.</p>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm text-gray-500">Fecha: 20 Nov, 2023</span>
                        <span class="block text-sm text-green-600 mt-1">En Progreso</span>
                    </div>
                </div>

                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                    <div class="flex flex-col">
                        <h4 class="font-semibold text-lg text-gray-800">Charla sobre Medio Ambiente</h4>
                        <p class="text-sm text-gray-600">Charla educativa sobre la importancia de cuidar el medio ambiente.</p>
                    </div>
                    <div class="text-right">
                        <span class="block text-sm text-gray-500">Fecha: 25 Nov, 2023</span>
                        <span class="block text-sm text-red-600 mt-1">Completada</span>
                    </div>
                </div>

            </div>

            <!-- Si no hay actividades -->
            <div class="text-center text-gray-600 mt-4">
                <p>No tienes actividades próximas.</p>
            </div>
        </div>
    </div>
</div>

  </div>


</div>

@endsection


