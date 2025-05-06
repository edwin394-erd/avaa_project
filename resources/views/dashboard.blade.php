@extends('layouts.layout')

@section('titulo-tab')
  Inicio
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto">
   <!-- Tarjetas de progreso -->
   <div class="flex flex-wrap p-2">
    @foreach ([
      ['title' => 'Voluntariado Interno', 'total' => $total_volin, 'meta' => $meta_volin, 'percentage' => $porcen_volin],
      ['title' => 'Voluntariado Externo', 'total' => $total_volex, 'meta' => $meta_volex, 'percentage' => $porcen_volex],
      ['title' => 'Talleres', 'total' => $total_taller, 'meta' => $meta_taller, 'percentage' => $porcen_taller],
      ['title' => 'Chat', 'total' => $total_chat, 'meta' => $meta_chat, 'percentage' => $porcen_chat],
    ] as $card)
      <div class="w-full sm:w-2/4 2xl:w-1/4 p-2">
        <div class="flex flex-col bg-white border shadow-xl shadow-green-600 rounded-xl">
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
</div>
@endsection
