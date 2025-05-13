@extends('layouts.layout')

@section('titulo')
AVAA - Test
@endsection

@section('titulo-tab')
AVAA - Test
@endsection

@section('contenido')

<div class="max-w-sm w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
    <div class="flex justify-between border-gray-200 border-b pb-3">
        <dl>
            <dt class="text-base font-normal text-gray-500 pb-1">Horas Totales</dt>
            <dd class="leading-none text-3xl font-bold text-gray-900">80 Horas</dd>
        </dl>
        <div>
            <span
                class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13V1m0 0L1 5m4-4 4 4" />
                </svg>
                Mes pasado 23.5%
            </span>
        </div>
    </div>

    <div class="grid grid-cols-2 py-3">
        <dl>
            <dt class="text-base font-normal text-gray-500 pb-1">Horas Completadas</dt>
            <dd class="leading-none text-xl font-bold text-green-500">40 Horas</dd>
        </dl>
        <dl>
            <dt class="text-base font-normal text-gray-500 pb-1">Horas Restantes</dt>
            <dd class="leading-none text-xl font-bold text-red-600">140 Hours</dd>
        </dl>
    </div>

    <div id="bar-chart"></div>
  
</div>

@endsection

@section('scripts')

<script>
const options = {
    series: [{
            name: "Hours Worked",
            color: "#31C48D",
            data: [23, 15, 18, 20, 14, 22],
        },
        {
            name: "Remaining Hours",
            data: [10, 12, 7, 5, 8, 3],
            color: "#F05252",
        }
    ],
    chart: {
        sparkline: {
            enabled: false,
        },
        type: "bar",
        width: "100%",
        height: 400,
        toolbar: {
            show: false,
        }
    },
    fill: {
        opacity: 1,
    },
    plotOptions: {
        bar: {
            horizontal: true,
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
        position: "bottom",
    },
    dataLabels: {
        enabled: false,
    },
    tooltip: {
        shared: true,
        intersect: false,
        formatter: function(value) {
            return value + " Hours"
        }
    },
    xaxis: {
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass: 'text-xs font-normal fill-gray-500'
            },
        },
        categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    yaxis: {
        labels: {
            show: true,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass: 'text-xs font-normal fill-gray-500'
            }
        }
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
        opacity: 1,
    }
}

if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("bar-chart"), options);
    chart.render();
}
</script>

@endsection