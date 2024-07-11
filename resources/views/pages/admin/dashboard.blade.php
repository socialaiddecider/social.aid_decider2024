@extends('layouts.admin.sidebar')

@php
    $badge = [
        'kriteria' => [
            'value' => 40689,
            'icon' =>
                'M2.789 13.57v-.75a2.25 2.25 0 0 1 2.25-2.25h15a2.25 2.25 0 0 1 2.25 2.25v.75m-8.69-6.44-2.121-2.12a1.5 1.5 0 0 0-1.06-.44h-5.38a2.25 2.25 0 0 0-2.25 2.25v12a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H14.66a1.5 1.5 0 0 1-1.06-.44',
            'badge' => '<svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61" fill="none">
  <path opacity=".21" fill-rule="evenodd" clip-rule="evenodd" d="M.539 30.32v10.8c0 6.72 0 10.08 1.308 12.648a12 12 0 0 0 5.244 5.244c2.567 1.308 5.927 1.308 12.648 1.308h21.6c6.72 0 10.08 0 12.648-1.308a12 12 0 0 0 5.244-5.244c1.308-2.567 1.308-5.928 1.308-12.648v-21.6c0-6.72 0-10.081-1.308-12.648a12 12 0 0 0-5.245-5.244C51.42.32 48.06.32 41.34.32h-21.6c-6.722 0-10.082 0-12.65 1.308a12 12 0 0 0-5.244 5.244C.538 9.439.538 12.799.538 19.52z" fill="#8280FF"/>
  <path opacity=".588" fill-rule="evenodd" clip-rule="evenodd" d="M21.205 23.653a5.333 5.333 0 1 0 10.667 0 5.333 5.333 0 0 0-10.667 0m13.334 5.334a4 4 0 1 0 8 0 4 4 0 0 0-8 0" fill="#8280FF"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M26.516 31.653c-6.295 0-11.46 3.236-11.977 9.6-.028.346.635 1.067.97 1.067h22.025c1.002 0 1.017-.806 1.002-1.067-.39-6.542-5.636-9.6-12.02-9.6M45.813 42.32h-5.141c0-3.001-.992-5.771-2.665-8 4.542.05 8.25 2.347 8.53 7.2.01.195 0 .8-.724.8" fill="#8280FF"/>
</svg>',
        ],
        'alternatif' => [
            'value' => 40689,
            'icon' =>
                'M15.539 14.32h-6m4.06-7.19-2.121-2.12a1.5 1.5 0 0 0-1.06-.44h-5.38a2.25 2.25 0 0 0-2.25 2.25v12a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H14.66a1.5 1.5 0 0 1-1.06-.44',
            'badge' => '<svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61" fill="none">
  <path opacity=".21" fill-rule="evenodd" clip-rule="evenodd" d="M.539 30.32v10.8c0 6.72 0 10.08 1.308 12.648a12 12 0 0 0 5.244 5.244c2.567 1.308 5.927 1.308 12.648 1.308h21.6c6.72 0 10.08 0 12.648-1.308a12 12 0 0 0 5.244-5.244c1.308-2.567 1.308-5.928 1.308-12.648v-21.6c0-6.72 0-10.081-1.308-12.648a12 12 0 0 0-5.245-5.244C51.42.32 48.06.32 41.34.32h-21.6c-6.722 0-10.082 0-12.65 1.308a12 12 0 0 0-5.244 5.244C.538 9.439.538 12.799.538 19.52z" fill="#668A6A"/>
  <path fill-rule="evenodd" clip-rule="evenodd" d="m15.539 24.636 12.9 7.448q.21.12.433.175v14.446l-12.413-7.347c-.57-.337-.92-.95-.92-1.613zm30-.198v13.307c0 .662-.35 1.276-.92 1.613l-12.414 7.347V32.133q.045-.023.09-.049z" fill="#668A6A"/>
  <path opacity=".499" fill-rule="evenodd" clip-rule="evenodd" d="M15.944 21.021c.157-.199.356-.367.588-.49l13.125-6.991a1.88 1.88 0 0 1 1.763 0l13.125 6.99q.27.145.474.36l-14.39 8.308a1.7 1.7 0 0 0-.262.186 1.7 1.7 0 0 0-.261-.186z" fill="#668A6A"/>
</svg>',
        ],
        'total Data' => [
            'value' => 40689,
            'icon' =>
                'M4.289 10.596a2 2 0 0 1 .344-.026h15.811q.177 0 .345.026m-16.5 0a2.25 2.25 0 0 0-1.884 2.542l.858 6A2.25 2.25 0 0 0 5.49 21.07h14.097a2.25 2.25 0 0 0 2.228-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6.82a2.25 2.25 0 0 1 2.25-2.25h3.878a1.5 1.5 0 0 1 1.06.44L13.6 7.13a1.5 1.5 0 0 0 1.06.44h3.88a2.25 2.25 0 0 1 2.25 2.25v.776',
            'badge' => '<svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61" fill="none">
  <path opacity=".21" d="M.539 19.52c0-6.72 0-10.081 1.308-12.648A12 12 0 0 1 7.09 1.628C9.658.32 13.018.32 19.739.32h21.6c6.72 0 10.08 0 12.648 1.308a12 12 0 0 1 5.244 5.244c1.308 2.567 1.308 5.927 1.308 12.648v21.6c0 6.72 0 10.08-1.308 12.648a12 12 0 0 1-5.245 5.244C51.42 60.32 48.06 60.32 41.34 60.32h-21.6c-6.721 0-10.081 0-12.648-1.308a12 12 0 0 1-5.244-5.244C.538 51.2.538 47.84.538 41.12z" fill="#4AD991"/>
  <path d="M19.65 42.709h23.333a1.556 1.556 0 0 1 0 3.11H18.094a1.555 1.555 0 0 1-1.555-1.555V19.375a1.556 1.556 0 1 1 3.11 0z" fill="#4AD991"/>
  <path opacity=".5" d="M25.451 35.995a1.556 1.556 0 1 1-2.27-2.128l5.834-6.222a1.556 1.556 0 0 1 2.144-.12l4.604 3.93 5.999-7.6a1.556 1.556 0 0 1 2.442 1.929l-7 8.866a1.556 1.556 0 0 1-2.23.22l-4.705-4.014z" fill="#4AD991"/>
</svg>',
        ],
        'Penerima' => [
            'value' => 40689,
            'icon' =>
                'M12.539 11.32v6m3-3h-6m4.06-7.19-2.121-2.12a1.5 1.5 0 0 0-1.06-.44h-5.38a2.25 2.25 0 0 0-2.25 2.25v12a2.25 2.25 0 0 0 2.25 2.25h15a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H14.66a1.5 1.5 0 0 1-1.06-.44',
            'badge' => '<svg xmlns="http://www.w3.org/2000/svg" width="61" height="61" viewBox="0 0 61 61" fill="none">
  <path opacity=".3" d="M.539 19.52c0-6.72 0-10.081 1.308-12.648A12 12 0 0 1 7.09 1.628C9.658.32 13.018.32 19.739.32h21.6c6.72 0 10.08 0 12.648 1.308a12 12 0 0 1 5.244 5.244c1.308 2.567 1.308 5.927 1.308 12.648v21.6c0 6.72 0 10.08-1.308 12.648a12 12 0 0 1-5.245 5.244C51.42 60.32 48.06 60.32 41.34 60.32h-21.6c-6.721 0-10.081 0-12.648-1.308a12 12 0 0 1-5.244-5.244C.538 51.2.538 47.84.538 41.12z" fill="#FF9066"/>
  <path opacity=".78" fill-rule="evenodd" clip-rule="evenodd" d="M29.17 24.129a.5.5 0 0 1 .498-.462h.418a.5.5 0 0 1 .498.45l.621 6.217 4.415 2.522a.5.5 0 0 1 .252.435v.388a.5.5 0 0 1-.632.482l-6.303-1.718a.5.5 0 0 1-.367-.521z" fill="#FF9066"/>
  <path opacity=".901" fill-rule="evenodd" clip-rule="evenodd" d="M23.26 15.304a.5.5 0 0 0-.869.206l-1.633 6.848a.5.5 0 0 0 .514.615l7.045-.4a.5.5 0 0 0 .355-.82l-1.802-2.147A11.3 11.3 0 0 1 30.539 19c6.259 0 11.333 5.075 11.333 11.334s-5.074 11.333-11.333 11.333-11.334-5.074-11.334-11.333c0-1.051.143-2.08.42-3.07l-2.568-.72a14 14 0 0 0-.518 3.79c0 7.732 6.268 14 14 14s14-6.268 14-14-6.268-14-14-14c-1.945 0-3.798.396-5.48 1.113z" fill="#FF9066"/>
</svg>',
        ],
    ];
@endphp

@section('contents-admin')
    <section class="kriteria py-6 px-8 overflow-y-auto no-scrollbar ">
        <div class="header mb-6">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
                <div class="action">
                    <button class="button flex gap-2 bg-neutral-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.6875 8.15954C3.05174 8.49776 3.6212 8.47667 3.95942 8.11243L6.29991 5.59191L6.29991 15.9C6.29991 16.3971 6.70285 16.8 7.19991 16.8C7.69696 16.8 8.09991 16.3971 8.09991 15.9V5.59191L10.4404 8.11243C10.7786 8.47667 11.3481 8.49776 11.7123 8.15954C12.0766 7.82132 12.0976 7.25186 11.7594 6.88762L7.85942 2.68762C7.68913 2.50423 7.45017 2.40002 7.19991 2.40002C6.94964 2.40002 6.71068 2.50423 6.54039 2.68762L2.64039 6.88762C2.30217 7.25186 2.32326 7.82132 2.6875 8.15954ZM12.2875 15.8405C11.9233 16.1787 11.9022 16.7482 12.2404 17.1124L16.1404 21.3124C16.3107 21.4958 16.5496 21.6 16.7999 21.6C17.0502 21.6 17.2891 21.4958 17.4594 21.3124L21.3594 17.1124C21.6976 16.7482 21.6765 16.1787 21.3123 15.8405C20.9481 15.5023 20.3786 15.5234 20.0404 15.8876L17.6999 18.4081V8.10003C17.6999 7.60297 17.297 7.20003 16.7999 7.20003C16.3028 7.20003 15.8999 7.60297 15.8999 8.10003V18.4081L13.5594 15.8876C13.2212 15.5234 12.6517 15.5023 12.2875 15.8405Z"
                                fill="#7F7F7F" />
                        </svg>
                        <h6>Sort</h6>
                    </button>
                </div>
            </div>
        </div>
        <div class="content-body p-4 relative flex flex-col gap-4">
            <div class="wrap-badge grid grid-cols-4 gap-4">
                @foreach ($badge as $key => $value)
                    <div
                        class="badge px-5 py-8 pb-10 bg-neutral-50 inline-flex items-center justify-evenly gap-4 rounded-xl">
                        <div class="body">
                            <div class="header-badge inline-flex items-center gap-3 p-3">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        viewBox="0 0 25 25" fill="none">
                                        <path d="{{ $value['icon'] }}" stroke="#050505" stroke-width="1.755"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h2 class="text-sm font-medium capitalize">{{ $key }}</h2>
                            </div>
                            <h1 class="text-3xl font-bold px-3">40,689</h1>
                        </div>
                        <div class="icon">
                            {!! $value['badge'] !!}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="graph grid grid-cols-2 gap-4">
                <div class="column-chart bg-neutral-50 px-11 py-6 rounded-xl">
                    <div class="header inline-flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"
                                stroke="#050505" stroke-width="1.755" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <h2 class="text-sm font-medium">Data Penilaian</h2>
                    </div>
                    <div id="column-chart"></div>
                </div>
                <div class="pie-area-charts flex flex-col gap-4 ">
                    <div class="pie-chart bg-neutral-50 px-11 py-6 rounded-xl">
                        <div class="header inline-flex gap-3 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"
                                    stroke="#050505" stroke-width="1.755" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <h2 class="text-sm font-medium">Data Alternatif</h2>
                        </div>
                        <div id="pie-chart"></div>
                    </div>
                    <div class="">
                        <div class="area-chart bg-neutral-50 px-11 py-6 rounded-xl">
                            <div id="area-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="module">
        var options = {
            series: [{
                name: 'Inflation',
                data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
            }],
            chart: {
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            },

        };

        let columnChart = new ApexCharts(document.querySelector("#column-chart"), options);

        columnChart.render();

        var options = {
            series: [44, 55, 41, 17, 15],
            chart: {
                type: 'donut',
                width: 480,
                height: 150
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 90,
                    offsetY: 10
                }
            },
            grid: {
                padding: {
                    bottom: -80
                }
            },
            legend: {
                position: 'left'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 100
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pie-chart"), options);
        pieChart.render();

        var options = {
            series: [{
                name: 'series1',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'series2',
                data: [11, 32, 45, 32, 34, 52, 41]
            }],
            chart: {
                height: 200,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                    "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                    "2018-09-19T06:30:00.000Z"
                ]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var lineChart = new ApexCharts(document.querySelector("#area-chart"), options);
        lineChart.render();
    </script>
@endpush
