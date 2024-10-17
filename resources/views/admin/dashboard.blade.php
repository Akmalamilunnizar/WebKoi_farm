@extends('admin.layouts.template')
@section('page_title')
    Dashboard - Single Ecom
@endsection
@section('js')
    <script src="{{ asset('assets/apexcharts/dist/apexcharts.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/apexcharts/dist/apexcharts.css') }}" />
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/apexcharts/dist/apexcharts.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0/dist/apexcharts.css"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"
        integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.css"
        integrity="sha512-5k2n0KtbytaKmxjJVf3we8oDR34XEaWP2pibUtul47dDvz+BGAhoktxn7SJRQCHNT5aJXlxzVd45BxMDlCgtcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ URL('assets/apexcharts/dist/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script>
        // Line Chart (Laporan Penjualan)
        var lineChartOptions = {
            series: [{
                name: "Total Pendapatan",
                data: @json($dataTotalPesanan)
            }],
            chart: {
                height: 345,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Laporan Penjualan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                }
            },
            xaxis: {
                categories: @json($dataBulan)
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR"
                        });
                    }
                }
            }
        };

        // Render the line chart in the 'lineChart' div
        var lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartOptions);
        lineChart.render();

        // Pie Chart (Example Pie Chart)
        var pieChartOptions = {
            series: [44, 55, 13, 43],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Team A', 'Team B', 'Team C', 'Team D'],
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
                                    <h5 class="card-title text-primary">Selamat datang {{ Auth::user()->f_name }}! 🎉</h5>
                                    <p class="mb-4">
                                        You have done <span class="fw-bold">72%</span> more sales today. Check your new
                                        badge in your profile.
                                        {{-- @dd($dataTotalPesanan) --}}
                                    </p>

                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                                </div>

                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('dashboard2/assets/img/illustrations/man-with-laptop-light.png') }}"
                                        height="140" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-1 order-md-1 order-lg-1 mb-4">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-body">
                                {{-- {!! #totalBuyingAndSellingChart !!} --}}
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-4 col-md-8 order-2 order-md-2 ">
                    <div class="row">
                        <div class="col-md-8 col-lg-12 col-xl-12 order-0 mb-4">
                            <div class="card">
                                <div id="pieChart"></div>
                                <div class="card-body">

                                    <span class="fw-semibold d-block mb-1">Total Akun</span>
                                    <h3 class="card-title mb-2">{{ $totalAllUsers }}</h3>
                                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                        +72.80%</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-4 order-3">
                    <div class="col-12 col-md-4 mb-2 order-md-3 order-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <!-- Responsive Table -->
                                    <div class="card">
                                        <h5 class="card-header">Keterangan: </h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead>
                                                    <tr class="text-nowrap">
                                                        <th>#</th>
                                                        <th>Parameter</th>
                                                        <th>Rentang Normal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>pH Balance</td>
                                                        <td>7.9 pH</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Suhu Air</td>
                                                        <td>27°C</td>

                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Tingkat TDS</td>
                                                        <td>485 PPM</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Tingkat Kekeruhan</td>
                                                        <td>3 NTU</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--/ Responsive Table -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-lg-12 col-md-12 col-sm-12 order-3 order-md-4">
                    <div class="row">
                        <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('dashboard2/assets/img/icons/unicons/ph-balance.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">pH</span>
                                    <h3 class="card-title text-nowrap mb-2">{{ $totalTypeFoods }}</h3>
                                    <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('dashboard2/assets/img/icons/unicons/thermometer.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Suhu</span>
                                    <h3 class="card-title mb-2">{{ $totalFoods }}</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('dashboard2/assets/img/icons/unicons/dissolved-oxygen-monitor.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">TDS</span>
                                    <h3 class="card-title mb-2">{{ $totalFoods }}</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('dashboard2/assets/img/icons/unicons/turbidity.png') }}"
                                                alt="Credit Card" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Keruh</span>
                                    <h3 class="card-title mb-2">{{ $totalFoods }}</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    </small>
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
