@extends('admin.layouts.template')
@section('page_title')
SANKE | Halaman Dashboard Admin
@endsection
@section('js')
<script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/logo/logo4.png') }}" type="image/png" />

{{--
<link rel="stylesheet" href="{{ URL::asset('assets/apexcharts/dist/apexcharts.css') }}"> --}}
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css"> --}}
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"
    integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.css"
    integrity="sha512-5k2n0KtbytaKmxjJVf3we8oDR34XEaWP2pibUtul47dDvz+BGAhoktxn7SJRQCHNT5aJXlxzVd45BxMDlCgtcA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
{{--
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ URL('assets/apexcharts/dist/apexcharts.min.js') }}"></script> --}}
{{--
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

<script>
    // Line Chart (Laporan Penjualan)
    // Line Chart (Laporan Sensor)
    var lineChartOptions = {
        series: [
            {
                name: "pH",
                data: @json($dataSensorPH)
            },
            {
                name: "Suhu",
                data: @json($dataSensorTemperature)
            },
            {
                name: "TDS",
                data: @json($dataSensorTDS)
            }
        ],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 5,
                borderRadiusApplication: 'end'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: @json($dataBulan),
            title: {
                text: 'Bulan'
            }
        },
        yaxis: {
            title: {
                text: 'Nilai Sensor'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val ;
                }
            }
        }
    };

    // Render the line chart in the 'lineChart' div
    var lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartOptions);
    lineChart.render();

    // Pie Chart (Example Pie Chart)
    var pieChartOptions = {
        series: [
            {{ $phValue }},
            {{ $temperatureValue }},
            {{ $tdsValue }}
        ],
        chart: {
            width: 435,
            type: 'pie',
        },
        labels: ['pH', 'Suhu', 'TDS'],
        legend: {
            position: 'bottom', // This places the legend at the bottom for all screen sizes
        },
        responsive: [{
            breakpoint: 450,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom' // Ensures the legend remains at the bottom for small screens
                }
            }
        }]
    };

    // Render the pie chart in the 'pieChart' div
    var pieChart = new ApexCharts(document.querySelector("#pieChart"), pieChartOptions);
    pieChart.render();
</script>
@endsection

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-12 order-0 mb-4">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title" style="color: black; font-weight: bold;">
                                    Selamat datang {{ Auth::user()->f_name }}! 🎉
                                </h5>
                                <p class="mb-4">
                                    <span class="fw-bold">"The genks koi 99 farm</span> Adalah teman2 pencinta koi
                                    di jember yg berdiri tgl 10-10-2019 dgn keanggotaan 5 orang dan mempunya kemitraan
                                    dgn petani di area Jember. The genks koi 99 farm hanya ingin memajukan perkoian di
                                    Jember"
                                </p>
                                <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-primary"
                                    style="background: linear-gradient(to right, #32CD32, #228B22); color: white; border: none;">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('dashboard2/assets/img/illustrations/image-removebg-preview (40).png') }}"
                                    height="220" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 order-1 order-md-1 order-lg-1 mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-8 order-2 order-md-2">
                <div class="row">
                    <div class="col-md-8 col-lg-12 col-xl-12 order-0 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="fw-bold text-dark mb-2">Keterangan</div>
                                <div id="pieChart"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12 col-sm-12 order-3 order-md-4">
                <div class="row">
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/ph-balance.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="d-block mb-1 text-center">pH</span>
                                <h3 class="card-title text-center mb-2">{{ $phValue }}</h3>
                                <small class="text-danger fw-semibold text-center"><i
                                        class="bx bx-down-arrow-alt"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/thermometer.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-center">Suhu</span>
                                <h3 class="card-title text-center mb-2">{{ $temperatureValue }}</h3>
                                <small class="text-success fw-semibold text-center"><i
                                        class="bx bx-up-arrow-alt"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="card-title d-flex align-items-center justify-content-center flex-column">
                                    <div class="avatar flex-shrink-0 text-center">
                                        <img src="{{ asset('dashboard2/assets/img/icons/unicons/dissolved-oxygen-monitor.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-center">TDS</span>
                                <h3 class="card-title text-center mb-2">{{ $tdsValue }}</h3>
                                <small class="text-success fw-semibold text-center"><i
                                        class="bx bx-up-arrow-alt"></i></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- / Content -->
@endsection

