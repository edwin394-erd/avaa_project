{{-- resources/views/users/show.blade.php --}}
@extends('layouts.layout')

@section('titulo-tab')
    Becario: {{ $user->becario->nombre ?? '' }} {{ $user->becario->apellido ?? '' }}
@endsection

@section('contenido')

<a href="{{ url()->previous() }}" class="inline-flex items-center mb-4 px-4 py-2 bg-gray-300 dark:bg-slate-800 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-slate-700 transition fixed z-50">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
    Volver
</a>

<div class="flex flex-col md:flex-row w-full py-10 px-4 gap-1">

    <!-- Lado Izquierdo: Información Personal -->
    <div class="w-full md:w-1/4 xl:w-1/4 px-0 xl:pr-2 mb-8 xl:mb-0 flex flex-col">
        <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-6 py-8 flex flex-col items-center relative">
            <!-- Botón Generar Reporte -->
            <a href="#"
               class="absolute top-4 right-4 bg-white hover:bg-gray-200 text-gray-800 dark:bg-slate-800 dark:text-white text-xs font-semibold px-3 py-2 rounded  transition border border-gray-300 dark:border-slate-700"
               title="Generar reporte">
                Generar Reporte
            </a><br>
            <!-- Foto de Perfil -->
            <div class="mb-4 flex flex-col items-center">
                <div class="relative w-28 h-28 mb-2">
                    <img src="{{ $user->fotoperfil ? asset('storage/' . $user->fotoperfil) : asset('imgs/default-profile.jpg') }}"
                         alt="Foto de perfil"
                         class="w-28 h-28 rounded-full object-cover border-2 border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-800">
                </div>
                <span class="text-base font-semibold text-gray-800 dark:text-gray-100 mt-2">
                    {{ $user->becario->nombre ?? '' }} {{ $user->becario->apellido ?? '' }}
                </span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
            </div>
            <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-4">
            <!-- Datos personales -->
            <div class="w-full ">
                <!-- Datos personales -->
                <div class="w-2/2 space-y-2">
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Cédula</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">{{ $user->becario->cedula }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Teléfono</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">
                            <a href="https://wa.me/+58{{ preg_replace('/\D/', '', $user->becario->telefono) }}"
                               target="_blank"
                               class="hover:underline text-green-600 dark:text-green-400 flex items-center gap-1">
                                <svg class="inline w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.18 1.6 6.01L0 24l6.18-1.62A11.93 11.93 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.21-1.25-6.23-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.93 9.93 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.8c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.32.42-.48.14-.16.18-.28.28-.46.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.83-2.01-.22-.53-.44-.46-.61-.47-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.27-.97.95-.97 2.3 0 1.35.99 2.66 1.13 2.85.14.18 1.95 2.99 4.74 4.07.66.23 1.18.37 1.58.47.66.17 1.26.15 1.73.09.53-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                                </svg>
                                {{ $user->becario->telefono }}
                            </a>
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Género</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">{{ $user->becario->genero }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Fecha de nacimiento</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">{{ $user->becario->fecha_nacimiento }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Dirección</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">{{ $user->becario->direccion }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 dark:text-gray-400">Carrera</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-gray-100">{{ $user->becario->carrera }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lado Derecho: Espacio para Gráficos y Estadísticas -->

    <div class="w-full md:w-3/4 xl:w-3/4 px-0 gap-0">
 <div class=" dark:bg-slate-900 rounded-lg  flex flex-col  w-3/3">
         <!-- Tarjetas de progreso -->
    <div class="flex flex-wrap">
        @foreach ([
              [
                'title' => 'Voluntariado Interno',
                'total' => $total_volin,
                'meta' => $meta_volin,
                'percentage' => $porcen_volin,
                'color' => 'text-[#28a745] dark:text-green-400',
                'bgcolor' => 'bg-green-400/40 dark:bg-green-900/40',
                'icono' => 'icon-volin.png',
                'name' => 'volin',
            ],
            [
                'title' => 'Voluntariado Externo',
                'total' => $total_volex,
                'meta' => $meta_volex,
                'percentage' => $porcen_volex,
                'color' => 'text-[#dc3545] dark:text-red-400',
                'bgcolor' => 'bg-red-400/40  dark:bg-red-900/40',
                'icono' => 'icon-volex.png',
                'name' => 'volex',
            ],
            [
                'title' => 'Chats',
                'total' => $total_chat,
                'meta' => $meta_chat,
                'percentage' => $porcen_chat,
                'color' => 'text-[#fd7e14] dark:text-orange-400',
                'bgcolor' => 'bg-yellow-400/40 dark:bg-orange-900/40',
                'icono' => 'icon-chat.png',
                'name' => 'chat',
            ],
            [
                'title' => 'Talleres',
                'total' => $total_taller,
                'meta' => $meta_taller,
                'percentage' => $porcen_taller,
                'color' => 'text-[#007bff] dark:text-blue-400',
                'bgcolor' => 'bg-blue-400/40 dark:bg-blue-900/40',
                'icono' => 'icon-taller.png',
                'name' => 'taller',
            ],
        ] as $card)
        <div class="w-full px-1 pb-3 w-1/2 md:w-2/4 lg:w-2/4 xl:w-1/4">
            <div class="flex flex-col bg-white dark:bg-slate-900 border  shadow-gray-300 dark:shadow-slate-800  border border-gray-200 dark:border-slate-700 rounded-xl hover:shadow-xl transition-shadow duration-300">
                <div class="pb-0 pt-4 px-0">
                    <div class="px-4">
                        <div class="flex items-center">
                            <img src="{{ asset('imgs/' . $card['icono']) }}" alt="{{ $card['title'] }} icono" class="w-12 h-12">
                            <h3 class="{{ $card['color'] }} text-lg font-bold ml-2">{{ $card['title'] }}</h3>
                        </div>
                    <hr class="dark:border-slate-700"><br>
                    <div class="flex flex-col lg:flex-row px-0 items-center lg:items-stretch">
                        <div class="w-full lg:w-2/5 flex justify-center lg:justify-start mb-2 lg:mb-0">
                            <div class="relative size-24 md:size-28">
                                <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <circle
                                        cx="18" cy="18"
                                        r="14"
                                        fill="none"
                                        class="stroke-current text-gray-200 dark:text-slate-700"
                                        stroke-width="4"
                                        :r="window.innerWidth >= 1200 ? 16 : 14"
                                        x-data
                                        x-init="$el.setAttribute('r', window.innerWidth >= 768 ? 16 : 14)"
                                    ></circle>
                                    <circle
                                        cx="18" cy="18"
                                        r="14"
                                        fill="none"
                                        class="stroke-current {{ $card['color'] }} progress-circle"
                                        stroke-width="4"
                                        stroke-dasharray="100"
                                        stroke-dashoffset="100"
                                        stroke-linecap="round"
                                        data-final-offset="{{ 100 - $card['percentage'] }}"
                                        :r="window.innerWidth >= 1200 ? 16 : 14"
                                        x-data
                                        x-init="$el.setAttribute('r', window.innerWidth >= 768 ? 16 : 14)"
                                    ></circle>
                                </svg>
                                <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <span class="text-center text-xl font-bold {{ $card['color'] }}">{{ $card['percentage'] }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-3/5 flex flex-col justify-center items-center lg:items-end space-y-1">
                            <span class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $card['total'] }} horas<span class="text-base font-semibold text-gray-500 dark:text-gray-300"></span></span>
                            <span class="text-[14px] text-gray-600 dark:text-gray-300">Meta: <span class="font-semibold text-green-600 dark:text-green-400">{{ $card['meta'] }}</span> horas</span>
                            <span class="text-[14px]  text-gray-600 dark:text-gray-300">Restante:
                                <span class="font-semibold {{ ($card['meta'] - $card['total']) > 0 ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-900 dark:text-green-300' }}">
                                    {{ $card['meta'] - $card['total'] }}
                                </span> horas
                            </span>
                        </div>
                    </div>
                    <br>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Fin de las tarjetas de progreso -->
</div>
<div class="xl:flex gap-2">
         <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-2 py-1 flex flex-col min-h-[400px] w-full xl:w-2/4">
          <div class="p-4 md:p-5 flex flex-col h-full">
                     <div class="flex items-center text">
                        <img src="{{ asset('imgs/icon-progen.png') }}" alt="icono" class="w-12 h-12 block dark:hidden">
                        <img src="{{ asset('imgs/icon-progen-blanco.png') }}" alt="icono" class="w-12 h-12 hidden dark:block">

                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 ml-2">Progreso del  Becario</h3>
                    </div>
                    <hr class="dark:border-slate-700">
                    <br>
                    <div class="justify-between border-gray-200 dark:border-slate-700 pb-3 text-center">
                        <dl>
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-300 pb-1">Horas Totales</dt>
                            <dd class="leading-none text-3xl font-bold text-gray-800 dark:text-gray-100">
                                {{$total_volin + $total_volex + $total_taller + $total_chat}} Horas</dd>
                        </dl>
                        <div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 py-3">
                        <dl class="text-left">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-300 pb-1">Meta Anual</dt>
                            <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">
                                {{$meta_volin + $meta_volex + $meta_chat + $meta_taller}} Horas</dd>
                        </dl>
                        <dl class="text-right">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-300 pb-1">Restantes</dt>
                            <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-400">
                                {{($meta_volin + $meta_volex + $meta_chat + $meta_taller)-($total_volin + $total_volex + $total_taller + $total_chat)}}
                                Horas</dd>
                        </dl>
                    </div>
                    <div id="bar-chart"></div>
                     <div id="chart-legend" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 p-4 lg:justify-center lg:text-center">
                        <div class="text-sm dark:text-white flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#16A34A] dark:bg-green-500 inline-block rounded-full mr-2"></span> Voluntariado Interno
                        </div>
                        <div class="text-sm dark:text-white flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#DC2626] dark:bg-red-500 inline-block rounded-full mr-2"></span> Voluntariado Externo
                        </div>
                        <div class="text-sm dark:text-white flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#F97316] dark:bg-orange-400 inline-block rounded-full mr-2"></span> Chats
                        </div>
                        <div class="text-sm  dark:text-white flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#2563EB] dark:bg-blue-400 inline-block rounded-full mr-2"></span> Talleres
                        </div>
                    </div>
                </div>
        </div>

         <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-2 py-1 flex flex-col min-h-[400px] w-full xl:w-2/4">
          <div class="p-4 md:p-5 flex flex-col h-full">
                     <div class="flex items-center text">
                        <img src="{{ asset('imgs/icon-progen.png') }}" alt="icono" class="w-12 h-12 block dark:hidden">
                        <img src="{{ asset('imgs/icon-progen-blanco.png') }}" alt="icono" class="w-12 h-12 hidden dark:block">

                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 ml-2">Cargadas Recientemente</h3>
                    </div>
                    <hr class="dark:border-slate-700"><br>
                       <div class="space-y-4 flex-grow max-h-[520px] overflow-y-auto ">
                        @forelse($stats_sinfiltro as $actividad)
                            <div class="flex items-center justify-between bg-gradient-to-r from-gray-50 via-white to-gray-100 dark:from-slate-800 dark:via-slate-900 dark:to-slate-800 p-5 rounded-2xl shadow transition-all duration-200 hover:shadow-xl border border-gray-200 dark:border-slate-700 group">
                                <div class="flex flex-col">
                                    <h4 class="font-semibold text-md md:text-lg text-gray-800 dark:text-blue-300 group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $actividad->titulo ?? $actividad->nombre ?? 'Actividad' }}
                                    </h4>
                                    <p class="text-sm md:text-base text-gray-500 dark:text-gray-300 mt-1 line-clamp-2">
                                        Becario: {{ $actividad->becario->nombre ?? '-' }} {{ $actividad->becario->apellido ?? '-' }}
                                    </p>
                                </div>
                                <div class="text-right ml-4 flex flex-col items-end">
                                    <span class="block text-xs md:text-sm text-gray-400 dark:text-gray-300 font-medium">
                                        {{ \Carbon\Carbon::parse($actividad->fecha ?? $actividad->created_at)->format('d M, Y') }}
                                    </span>
                                    <span class="inline-block px-2 py-1 mt-2 rounded-full text-xs font-semibold
                                        @if(isset($actividad->estado))
                                            @if($actividad->estado == 'pendiente') bg-yellow-100 dark:bg-slate-800 text-yellow-700 dark:text-yellow-300 border border-yellow-300 dark:border-yellow-700
                                            @elseif($actividad->estado == 'aprobado') bg-green-100 dark:bg-slate-800 text-green-700 dark:text-green-300 border border-green-300 dark:border-green-700
                                            @elseif($actividad->estado == 'rechazado') bg-red-100 dark:bg-slate-800 text-red-700 dark:text-red-400 border border-red-300 dark:border-red-700
                                            @else bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-slate-600
                                            @endif
                                        @else
                                            bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-slate-600
                                        @endif
                                    ">
                                        {{ $actividad->estado ?? 'Sin estado' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center text-center text-gray-400 dark:text-gray-500 mt-8">
                                <svg class="w-12 h-12 mb-2 text-gray-200 dark:text-slate-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                </svg>
                                <p class="text-base font-medium">No tiene actividades recientes.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
        </div>

</div>


        <!-- Puedes agregar más secciones de estadísticas o detalles aquí -->





    </div>
</div>
@endsection

@section('scripts')
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const total_anual_por_mes = @json($total_por_mes);
    const total_volin_por_mes = @json($total_volin_por_mes);
    const total_volex_por_mes = @json($total_volex_por_mes);
    const total_taller_por_mes = @json($total_taller_por_mes);
    const total_chat_por_mes = @json($total_chat_por_mes);

    const currentDate = new Date();

    function getLastSixMonthIndexes() {
        const indexes = [];
        for (let i = 5; i >= 0; i--) {
            indexes.push((currentDate.getMonth() - i + 12) % 12);
        }
        return indexes;
    }

    const lastSixMonthIndexes = getLastSixMonthIndexes();

    let horasUltimos6MesesVolin = lastSixMonthIndexes.map(index => total_volin_por_mes[(index + 1) % 12] ?? 0);
    let horasUltimos6MesesVolex = lastSixMonthIndexes.map(index => total_volex_por_mes[(index + 1) % 12] ?? 0);
    let horasUltimos6MesesTaller = lastSixMonthIndexes.map(index => total_taller_por_mes[(index + 1) % 12] ?? 0);
    let horasUltimos6MesesChat = lastSixMonthIndexes.map(index => total_chat_por_mes[(index + 1) % 12] ?? 0);

    function getLastSixMonths() {
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        return lastSixMonthIndexes.map(index => months[index]);
    }

    let months = getLastSixMonths();
    const isHorizontal = window.innerWidth < 640;

    if (isHorizontal) {
        months = months.slice().reverse();
        horasUltimos6MesesVolin = horasUltimos6MesesVolin.slice().reverse();
        horasUltimos6MesesVolex = horasUltimos6MesesVolex.slice().reverse();
        horasUltimos6MesesTaller = horasUltimos6MesesTaller.slice().reverse();
        horasUltimos6MesesChat = horasUltimos6MesesChat.slice().reverse();
    }

    function getBarColors() {
        const isDark = document.documentElement.classList.contains('dark');
        if (isDark) {
            return months.map((_, i) => i % 2 === 0 ? "#1e293b" : "#0f172a");
        } else {
            return months.map((_, i) => i % 2 === 0 ? "#E5E7EB" : "#FFFFFF");
        }
    }

    function renderChart() {
        let barColors = getBarColors();
        const isDark = document.documentElement.classList.contains('dark');
        const options2 = {
            series: [
                {
                    name: "Voluntariado Interno",
                    color: "#16A34A",
                    data: horasUltimos6MesesVolin,
                },
                {
                    name: "Voluntariado Externo",
                    color: "#dc2626",
                    data: horasUltimos6MesesVolex,
                },
                {
                    name: "Chat",
                    color: "#f97316",
                    data: horasUltimos6MesesChat,
                },
                {
                    name: "Talleres",
                    color: "#2563EB",
                    data: horasUltimos6MesesTaller,
                },
            ],
            chart: {
                sparkline: { enabled: false },
                type: "bar",
                width: "100%",
                height: window.innerWidth >= 640 ? 300 : 800,
                toolbar: { show: false },
                background: isDark ? "#0f172a" : "#fff",
                events: {
                    mounted: function(chartContext, config) {
                        if (typeof addBarHoverEffect === "function") addBarHoverEffect();
                    },
                    updated: function(chartContext, config) {
                        if (typeof addBarHoverEffect === "function") addBarHoverEffect();
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: isHorizontal,
                    columnWidth: "90%",
                    borderRadiusApplication: "end",
                    borderRadius: 6,
                    dataLabels: {
                        position: window.innerWidth >= 640 ? "top" : "center",
                    },
                },
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: "center",
                floating: false,
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
                fontWeight: 400,
                width: "100%",
                height: 40,
                offsetX: 0,
                offsetY: 0,
            },
            tooltip: {
                enabled: false,
                shared: true,
                intersect: false,
                fillSeriesColor: false,
                x: { show: true },
                y: {
                    formatter: function (value, { seriesIndex, w }) {
                        return `${w.config.series[seriesIndex].name}: ${value} Horas`;
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
                row: {
                    colors: isHorizontal ? barColors : undefined,
                },
                column: {
                    colors: !isHorizontal ? barColors : undefined,
                },
            },
            fill: { opacity: 1 },
        };

        if (window.chart) {
            window.chart.destroy();
        }
        window.chart = new ApexCharts(document.getElementById("bar-chart"), options2);
        window.chart.render();
    }

    // Renderiza el gráfico al cargar
    renderChart();

    // Vuelve a renderizar el gráfico al cambiar el modo claro/oscuro
    const observer = new MutationObserver(() => {
        renderChart();
    });
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

    // Si tienes un botón toggle-dark, también vuelve a renderizar al hacer click
    const toggleDark = document.getElementById('toggle-dark');
    if (toggleDark) {
        toggleDark.addEventListener('click', function() {
            setTimeout(renderChart, 300); // Espera a que cambie el tema
        });
    }});

     // Animación de los círculos de progreso
    document.querySelectorAll(".progress-circle").forEach(circle => {
        const finalOffset = circle.getAttribute("data-final-offset");
        circle.style.setProperty("--final-offset", finalOffset);
        circle.style.animation = "none";
        void circle.offsetWidth;
        circle.style.animation = "progressAnimation 1.5s forwards";
    });
    </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('a[title="Generar reporte"]')?.addEventListener('click', function(e) {
        e.preventDefault();

        // Cargar las stats del becario vía fetch (igual que en stats.index)
        fetch("{{ route('stats.all', ['user_id' => $user->id]) }}")
            .then(res => res.json())
            .then(allStats => {
                const nombreUsuario = @json(($user->becario->nombre ?? '') . ' ' . ($user->becario->apellido ?? ''));
                const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
                const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

                // Filtrar solo stats del becario actual
                const rows = allStats
                    .filter(stat => stat.becario && stat.becario.user_id == {{ $user->id }})
                    .map(stat => [
                        stat.titulo,
                        stat.actividad === 'volin' ? 'Voluntariado Interno' :
                        stat.actividad === 'volex' ? 'Voluntariado Externo' :
                        stat.actividad === 'chat' ? 'Chat' :
                        stat.actividad === 'taller' ? 'Taller' :
                        stat.actividad,
                        stat.fecha ? new Date(stat.fecha).toLocaleDateString('es-VE') : '',
                        stat.modalidad,
                        stat.duracion,
                        stat.estado === 'pendiente' ? 'PENDIENTE' : (stat.estado === 'rechazado' ? 'RECHAZADO' : (stat.anulado === 'SI' ? 'ANULADO' : 'APROBADO'))
                    ]);

                // Cargar logo y generar PDF
                const toDataURL = (url, callback) => {
                    const xhr = new XMLHttpRequest();
                    xhr.onload = function() {
                        const reader = new FileReader();
                        reader.onloadend = function() {
                            callback(reader.result);
                        }
                        reader.readAsDataURL(xhr.response);
                    };
                    xhr.onerror = function() {
                        callback('');
                    };
                    xhr.open('GET', url);
                    xhr.responseType = 'blob';
                    xhr.send();
                };

                toDataURL(logoUrl, function(logoBase64) {
                    if (logoBase64) {
                        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);
                    }
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

                    // Previsualizar en nueva pestaña
                    const blob = doc.output('blob');
                    const blobUrl = URL.createObjectURL(blob);
                    window.open(blobUrl, '_blank');
                });
            });
    });
});
</script>
@endsection
