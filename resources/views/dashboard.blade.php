@extends('layouts.layout')

@section('titulo-tab')
Inicio
@endsection
{{-- @section('body-style')
    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('imgs/avaa.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection --}}

@section('contenido')
<div class="2xl:w-5/6 mx-auto py-5 px-0 md:px-10 min-h-full">
    @php
        // Hora de Venezuela (UTC-4)
        $horaVenezuela = \Carbon\Carbon::now('America/Caracas')->hour;
        if ($horaVenezuela >= 6 && $horaVenezuela < 12) {
            $saludo = 'Buenos días';
        } elseif ($horaVenezuela >= 12 && $horaVenezuela < 19) {
            $saludo = 'Buenas tardes';
        } else {
            $saludo = 'Buenas noches';
        }
    @endphp
    <h1 class="text-lg 2xl:text-2xl font-bold text-gray-800 text-center">
        {{ $saludo }}, {{$nombre_becario}} &#9995;
    </h1>
    <h2 class="text-md 2xl:text-lg font-semibold text-gray-600 text-center">Aquí tienes un resumen de tu progreso &#x1F4C8; </h2>
    <hr class="my-4">

    <!-- Tarjetas de progreso -->
    <div class="flex flex-wrap">
        @foreach ([
            [
                'title' => 'Voluntariado Interno',
                'total' => $total_volin,
                'meta' => $meta_volin,
                'percentage' => $porcen_volin,
                'color' => 'text-[#28a745]',
                'bgcolor' => 'bg-[#e3f7e7]',
                'icono' => 'icon-volin.png',
            ],
            [
                'title' => 'Voluntariado Externo',
                'total' => $total_volex,
                'meta' => $meta_volex,
                'percentage' => $porcen_volex,
                'color' => 'text-[#dc3545]',
                'bgcolor' => 'bg-[#f9e5e7]',
                'icono' => 'icon-volex.png',
            ],
            [
                'title' => 'Chats',
                'total' => $total_chat,
                'meta' => $meta_chat,
                'percentage' => $porcen_chat,
                'color' => 'text-[#fd7e14]',
                'bgcolor' => 'bg-[#fcf2ea]',
                'icono' => 'icon-chat.png',
            ],
            [
                'title' => 'Talleres',
                'total' => $total_taller,
                'meta' => $meta_taller,
                'percentage' => $porcen_taller,
                'color' => 'text-[#007bff]',
                'bgcolor' => 'bg-[#e0eaff]',
                'icono' => 'icon-taller.png',
            ],
        ] as $card)
        <div class="w-full sm:w-2/4 lg:w-1/4 p-1">
            <div class="flex flex-col bg-white border shadow-lg shadow-gray-300 border border-gray-200 rounded-xl hover:shadow-xl transition-shadow duration-300">
                <div class="pb-0 pt-4 px-0">
                    <div class="px-4">
                        <div class="flex items-center text">
                            <img src="{{ asset('imgs/' . $card['icono']) }}" alt="{{ $card['title'] }} icono" class="w-12 h-12">
                            <h3 class="{{ $card['color'] }} text-lg font-bold ml-2">{{ $card['title'] }}</h3>
                        </div>


                    <hr><br>
                    <div class="flex">
                        <div class="w-3/5">
                            <div class="relative size-24 md:size-28">
                                <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-gray-200" stroke-width="4"></circle>
                                    <circle
                                        cx="18" cy="18" r="16" fill="none" class="stroke-current {{ $card['color'] }} progress-circle"
                                        stroke-width="4"
                                        stroke-dasharray="100"
                                        stroke-dashoffset="100"
                                        stroke-linecap="round"
                                        data-final-offset="{{ 100 - $card['percentage'] }}">
                                    </circle>
                                </svg>
                                <div class="absolute top-1/2 start-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                    <span
                                        class="text-center text-xl font-bold {{ $card['color'] }}">{{ $card['percentage'] }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-3/5 flex flex-col justify-top">
                            <h1 class="text-right text-xl lg:text-xl">{{ $card['total'] }} horas</h1>
                            <h2 class="text-right text-md lg:text-md">Meta: {{ $card['meta'] }} horas</h2>
                            <h2 class="text-right text-md lg:text-md text-yellow-900">Restante:
                                {{ $card['meta'] - $card['total'] }} horas</h2>
                        </div>
                    </div>
                    <br>
                    </div>
                    <div class="text-center pb-4 {{ $card['bgcolor'] }} rounded-b-xl">
                         <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none text-center items-center {{ $card['color'] }}"
                        href="#">
                        Ver detalle
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Fin de las tarjetas de progreso -->

    <div class="flex flex-wrap">
        <div class="w-full md:w-4/4 lg:w-2/4 p-1">
            <div class="flex flex-col bg-white border shadow-lg shadow-gray-300 borber border-gray-200 rounded-xl h-full min-h-[600px]">
                <div class="p-4 md:p-5 flex flex-col h-full">
                    <div class="flex items-center text">
                        <img src="{{ asset('imgs/icon-actprox.png') }}" alt="icono" class="w-12 h-12">
                        <h3 class="text-lg font-bold text-gray-800 ml-2">Actividades Próximas</h3>
                    </div>
                    <hr>
                    <br>
                    <!-- Lista de actividades -->
                    <div class="space-y-4 flex-grow">
                        <div
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <div class="flex flex-col">
                                <h4 class="font-semibold text-lg text-gray-800">Voluntariado Externo</h4>
                                <p class="text-sm text-gray-600">Actividad de voluntariado en el evento de limpieza del
                                    parque.</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm text-gray-500">Fecha: 15 Nov, 2023</span>
                                <span class="block text-sm text-yellow-600 mt-1">Pendiente</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <div class="flex flex-col">
                                <h4 class="font-semibold text-lg text-gray-800">Taller de Liderazgo</h4>
                                <p class="text-sm text-gray-600">Taller sobre habilidades de liderazgo para jóvenes en
                                    la comunidad.</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm text-gray-500">Fecha: 20 Nov, 2023</span>
                                <span class="block text-sm text-green-600 mt-1">En Progreso</span>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between bg-gray-50 p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <div class="flex flex-col">
                                <h4 class="font-semibold text-lg text-gray-800">Charla sobre Medio Ambiente</h4>
                                <p class="text-sm text-gray-600">Charla educativa sobre la importancia de cuidar el
                                    medio ambiente.</p>
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
                    <div class="flex-grow"></div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-4/4 lg:w-2/4 p-1">
            <div class="flex flex-col bg-white border shadow-lg shadow-gray-300 borber border-gray-200 rounded-xl h-full min-h-[600px]">
                <div class="p-4 md:p-5 flex flex-col h-full">
                     <div class="flex items-center text">
                        <img src="{{ asset('imgs/icon-progen.png') }}" alt="icono" class="w-12 h-12">
                        <h3 class="text-lg font-bold text-gray-800 ml-2">Progreso General</h3>
                    </div>
                    <hr>
                    <br>
                    <div class="justify-between border-gray-200 border-b pb-3 text-center">
                        <dl>
                            <dt class="text-base font-normal text-gray-500 pb-1">Horas Totales</dt>
                            <dd class="leading-none text-3xl font-bold text-gray-800">
                                {{$total_volin + $total_volex + $total_taller + $total_chat}} Horas</dd>
                        </dl>
                        <div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 py-3">
                        <dl class="text-left">
                            <dt class="text-base font-normal text-gray-500 pb-1">Meta Anual</dt>
                            <dd class="leading-none text-xl font-bold text-green-500">
                                {{$meta_volin + $meta_volex + $meta_chat + $meta_taller}} Horas</dd>
                        </dl>
                        <dl class="text-right">
                            <dt class="text-base font-normal text-gray-500 pb-1">Restantes</dt>
                            <dd class="leading-none text-xl font-bold text-red-600">
                                {{($meta_volin + $meta_volex + $meta_chat + $meta_taller)-($total_volin + $total_volex + $total_taller + $total_chat)}}
                                Horas</dd>
                        </dl>
                    </div>
                    <div id="bar-chart"></div>
                    <div id="chart-legend" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 p-4 lg:justify-center lg:text-center">
                        <div class="text-sm flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#16A34A] inline-block rounded-full mr-2"></span> Voluntariado Interno
                        </div>
                        <div class="text-sm flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#DC2626] inline-block rounded-full mr-2"></span> Voluntariado Externo
                        </div>
                        <div class="text-sm flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#F97316] inline-block rounded-full mr-2"></span> Chats
                        </div>
                        <div class="text-sm flex items-center lg:justify-center justify-start mb-2">
                            <span class="w-4 h-4 bg-[#2563EB] inline-block rounded-full mr-2"></span> Talleres
                        </div>
                    </div>
                    <div class="flex-grow"></div>
                </div>
            </div>
        </div>


    </div>

    </div>


</div>

@endsection

@section('scripts')
<script>
const total_anual_por_mes = @json($total_por_mes);
const total_volin_por_mes = @json($total_volin_por_mes);
const total_volex_por_mes = @json($total_volex_por_mes);
const total_taller_por_mes = @json($total_taller_por_mes);
const total_chat_por_mes = @json($total_chat_por_mes);

console.log("anual:" + total_anual_por_mes);
console.log("volin:" + total_volin_por_mes);
console.log("volex:" + total_volex_por_mes);
console.log("taller:" + total_taller_por_mes);
console.log("chat:" + total_chat_por_mes);

// Obtener la fecha actual
const currentDate = new Date();

// Función para obtener los índices de los últimos 6 meses
function getLastSixMonthIndexes() {
    const indexes = [];
    for (let i = 5; i >= 0; i--) {
        indexes.push((currentDate.getMonth() - i + 12) % 12);
    }
    return indexes;
}

const lastSixMonthIndexes = getLastSixMonthIndexes();
console.log("lastSixMonthIndexes:" + lastSixMonthIndexes);

// Extraer los últimos 6 meses de cada actividad
let horasUltimos6MesesVolin = lastSixMonthIndexes.map(index => total_volin_por_mes[(index + 1) % 12] ?? 0);
let horasUltimos6MesesVolex = lastSixMonthIndexes.map(index => total_volex_por_mes[(index + 1) % 12] ?? 0);
let horasUltimos6MesesTaller = lastSixMonthIndexes.map(index => total_taller_por_mes[(index + 1) % 12] ?? 0);
let horasUltimos6MesesChat = lastSixMonthIndexes.map(index => total_chat_por_mes[(index + 1) % 12] ?? 0);

// Obtener los nombres de los últimos 6 meses
function getLastSixMonths() {
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return lastSixMonthIndexes.map(index => months[index]);
}

let months = getLastSixMonths(); // Obtenemos los últimos 6 meses dinámicamente

// Detectar si el gráfico será horizontal
const isHorizontal = window.innerWidth < 640;

// Si es horizontal, invertir el orden de los datos y los meses
if (isHorizontal) {
    months = months.slice().reverse();
    horasUltimos6MesesVolin = horasUltimos6MesesVolin.slice().reverse();
    horasUltimos6MesesVolex = horasUltimos6MesesVolex.slice().reverse();
    horasUltimos6MesesTaller = horasUltimos6MesesTaller.slice().reverse();
    horasUltimos6MesesChat = horasUltimos6MesesChat.slice().reverse();
}

console.log("horasUltimos6MesesVolin:" + horasUltimos6MesesVolin);
console.log("horasUltimos6MesesVolex:" + horasUltimos6MesesVolex);
console.log("horasUltimos6MesesTaller:" + horasUltimos6MesesTaller);
console.log("horasUltimos6MesesChat:" + horasUltimos6MesesChat);

// Alternar sombreado de fondo para cada mes
const barColors = months.map((_, i) => i % 2 === 0 ? "#E5E7EB" : "#FFFFFF"); // gris claro y blanco

const options2 = {
    series: [{
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
        sparkline: {
            enabled: false
        },
        type: "bar",
        width: "100%",
        height: window.innerWidth >= 640 ? 300 : 800,
        toolbar: {
            show: false
        },
        events: {
            mounted: function(chartContext, config) {
                addBarHoverEffect();
            },
            updated: function(chartContext, config) {
                addBarHoverEffect();
            }
        }
    },
    plotOptions: {
        bar: {
            horizontal: isHorizontal,
            columnWidth: "100%",
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
        x: {
            show: true,
        },
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
        axisTicks: {
            show: false
        },
        axisBorder: {
            show: false
        },
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
        padding: {
            left: 2,
            right: 2,
            top: -20
        },
        row: {
            colors: isHorizontal ? barColors : undefined, // para barras horizontales
        },
        column: {
            colors: !isHorizontal ? barColors : undefined, // para barras verticales
        },
    },
    fill: {
        opacity: 1
    },
};

if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("bar-chart"), options2);
    chart.render();
}

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".progress-circle").forEach(circle => {
    const finalOffset = circle.getAttribute("data-final-offset");
    circle.style.setProperty("--final-offset", finalOffset);
    // Quita la animación si existe
    circle.style.animation = "none";
    // Fuerza el reflow
    void circle.offsetWidth;
    // Ahora aplica la animación
    circle.style.animation = "progressAnimation 1.5s forwards";
  });
});
</script>

@endsection
