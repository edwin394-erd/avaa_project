@extends('layouts.layout')

@section('titulo-tab')
Inicio
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto py-10 px-0 md:px-10 min-h-full">
    <h1 class="text-2xl font-bold text-gray-800 text-center">Bienvenido, {{$nombre_becario}}</h1>
    <h2 class="text-lg font-semibold text-gray-600 text-center">Aquí tienes un resumen de tu progreso</h2>
    <hr class="my-4">

    <!-- Tarjetas de progreso -->
    <div class="flex flex-wrap">
        @foreach ([
            [
                'title' => 'Voluntariado Interno',
                'total' => $total_volin,
                'meta' => $meta_volin,
                'percentage' => $porcen_volin,
                'color' => 'text-green-600'
            ],
            [
                'title' => 'Voluntariado Externo',
                'total' => $total_volex,
                'meta' => $meta_volex,
                'percentage' => $porcen_volex,
                'color' => 'text-red-600'
            ],
            [
                'title' => 'Chats',
                'total' => $total_chat,
                'meta' => $meta_chat,
                'percentage' => $porcen_chat,
                'color' => 'text-orange-500'
            ],
            [
                'title' => 'Talleres',
                'total' => $total_taller,
                'meta' => $meta_taller,
                'percentage' => $porcen_taller,
                'color' => 'text-blue-600'
            ],
        ] as $card)
        <div class="w-full sm:w-2/4 2xl:w-1/4 p-2">
            <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800">{{ $card['title'] }}</h3>
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
                                        style="animation: progressAnimation 1.5s forwards;"
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
                    <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-green-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none"
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
        @endforeach
    </div>
    <!-- Fin de las tarjetas de progreso -->

    <div class="flex flex-wrap">
        <div class="w-full md:w-4/4 2xl:w-2/4 p-2">
            <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl h-full min-h-[600px]">
                <div class="p-4 md:p-5 flex flex-col h-full">
                    <h3 class="text-lg font-bold text-gray-800">Progreso General</h3>
                    <hr>
                    <br>
                    <div class="justify-between border-gray-200 border-b pb-3 text-center">
                        <dl>
                            <dt class="text-base font-normal text-gray-500 pb-1">Horas Totales</dt>
                            <dd class="leading-none text-3xl font-bold text-gray-900">
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
                    <div id="chart-legend" class="md:flex justify-center text-center gap-4 p-4">
                        <div class=" text-sm flex text-center items-center md:justify-center mb-2 w-2/4 md:w-1/4 ">
                            <span class="w-4 h-4 bg-[#16A34A] inline-block rounded-full mr-2 "></span> Volunatariado Interno
                        </div>
                        <div class=" text-sm flex text-center items-center md:justify-center mb-2 w-2/4 md:w-1/4 ">
                            <span class="w-4  h-4 bg-[#DC2626] inline-block rounded-full mr-2 "></span> Voluntariado Externo
                        </div>
                        <div class=" text-sm flex text-center items-center md:justify-center mb-2 w-2/4 md:w-1/4 ">
                            <span class="w-4  h-4 bg-[#F97316] inline-block rounded-full mr-2 "></span> Chats
                        </div>
                        <div class=" text-sm flex text-center items-center md:justify-center mb-2 w-2/4 md:w-1/4 ">
                            <span class="w-4  h-4 bg-[#2563EB] inline-block rounded-full mr-2 "></span> Talleres
                        </div>
                    </div>
                    <div class="flex-grow"></div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-4/4 2xl:w-2/4 p-2">
            <div class="flex flex-col bg-white border shadow-lg shadow-green-600 rounded-xl h-full min-h-[600px]">
                <div class="p-4 md:p-5 flex flex-col h-full">
                    <h3 class="text-lg font-bold text-gray-800">Actividades Próximas</h3>
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
const horasUltimos6MesesVolin = lastSixMonthIndexes.map(index => total_volin_por_mes[(index + 1) % 12] ?? 0);
const horasUltimos6MesesVolex = lastSixMonthIndexes.map(index => total_volex_por_mes[(index + 1) % 12] ?? 0);
const horasUltimos6MesesTaller = lastSixMonthIndexes.map(index => total_taller_por_mes[(index + 1) % 12] ?? 0);
const horasUltimos6MesesChat = lastSixMonthIndexes.map(index => total_chat_por_mes[(index + 1) % 12] ?? 0);

console.log("horasUltimos6MesesVolin:" + horasUltimos6MesesVolin);
console.log("horasUltimos6MesesVolex:" + horasUltimos6MesesVolex);
console.log("horasUltimos6MesesTaller:" + horasUltimos6MesesTaller);
console.log("horasUltimos6MesesChat:" + horasUltimos6MesesChat);

// Obtener los nombres de los últimos 6 meses
function getLastSixMonths() {
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return lastSixMonthIndexes.map(index => months[index]);
}

const months = getLastSixMonths(); // Obtenemos los últimos 6 meses dinámicamente

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
        height: 400,
        toolbar: {
            show: false
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "100%",
            borderRadiusApplication: "end",
            borderRadius: 6,
            dataLabels: {
            position: "top",

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
  });
});
</script>

@endsection
