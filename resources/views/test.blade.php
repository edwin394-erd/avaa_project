@extends('layouts.layout')

@section('titulo')
AVAA - Test
@endsection

@section('titulo-tab')
AVAA - Test
@endsection

@section('contenido')
<form action="{{route('imagenes.store')}}" id="dropzone" enctype="multipart/form-data"
    class="dropzone border-dashed border-2 border-black w-full h-4 rounded flex flex-col justify-center items-center mb-4" method="POST">
    @csrf
    <input type="file" name="imagen[]" style="display:none;">
    @error('imagen')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
    @enderror
</form>

@endsection

    @section('scripts')

    <script>
    const options = {
        series: [{
                name: "Income",
                color: "#31C48D",
                data: ["1420", "1620", "1820", "1420", "1650", "2120"],
            },
            {
                name: "Expense",
                data: ["788", "810", "866", "788", "1100", "1200"],
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
            customLegendItems: ["Ganancias", "Pérdidas"],
            labels: {
                useSeriesColors: true
            }
        },
        dataLabels: {
            enabled: false,
        },
        tooltip: {
            shared: true,
            intersect: false,
            formatter: function(value) {
                return "$" + value
            }
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                },
                formatter: function(value) {
                    return "$" + value
                }
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
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
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

    // circular chart
    const getChartOptions = () => {
        return {
            series: [90],
            colors: ["#1C64F2"],
            chart: {
                type: "radialBar",
                height: 300,
                offsetY: 0,
                offsetX: 0,
                sparkline: {
                    enabled: true,
                },
            },
            plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        show: true,
                        offsetY: 8,
                        fontSize: "24px",
                        color: "#000",
                    }
                }
            }
        },
        stroke: {
            lineCap: "round",
        },
           
            labels: [""],
            legend: {
                show: false,
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
        }
    }

    if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.querySelector("#radial-chart"), getChartOptions());
        chart.render();
    }
    </script>

    @endsection