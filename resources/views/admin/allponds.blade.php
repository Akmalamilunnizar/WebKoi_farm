@extends('admin.layouts.template')
@section('page_title')
    SANKE | Halaman Semua Kolam Koi
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchpond') }}>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}"
                    aria-label="Pencarian..." style="600px" />
            </form>
        </div>
    </div>
@endsection
@section('content')
    {{--
<link rel="stylesheet" type="text/css" href="{{ asset('resources/css/app.css') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/style.scss'])
    <div class="layout-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <a href="{{ route('addponds') }}" class="btn btn-success ms-auto mb-3"
                style="background: linear-gradient(45deg, #28a745, #34d058);">
                + Tambah Kolam
            </a>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card ">
                <h5 class="card-header d-flex flex-wrap justify-content-between">Kolam Yang Tersedia
                    <a href="{{ route('manageponds') }}" class="btn rounded-pill btn-primary"><span
                            class="tf-icons bx bx-cog"></span>&nbsp; Kelola Kolam</a>
                </h5>
                <div class="row m-0 p-4">
                    <div class="col-12 p-2 d-flex mb-2 br5">
                        <div class="card h-500 p-6 position-relative"> <!-- Make the card container relative -->
                            @foreach ($ponds as $pond)
                                <div class="position-relative">
                                    <div class="box vintage">
                                        <img class="card-img-top" src="/uploads/{{ $pond->img }}" alt="Card image cap">
                                        <h2 class="mb-0 text-white" style="font-weight: 700">{{ $pond->name }}</h2>
                                        <p>28°C & Volume {{ $pond->volume }}</p>
                                        <dd class="col-sm-3">Id Kolam = {{ $pond->id }}</dd>
                                        <dt class="col-sm-9">Volume Kolam = {{ $pond->volume }}</dt>
                                        <!-- Menampilkan Jumlah Ikan -->
                                        <dd class="col-sm-3">Jumlah Ikan =
                                            {{ $jml_ikan->where('pond_id', $pond->id)->first()->jml_ikan ?? 'Data tidak tersedia' }}
                                        </dd>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                    <dl class="row mt-2">
                                        {{-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked
                                            autocomplete="off" />
                                        <label class="btn btn-outline-primary" for="btnradio1"><span
                                                class="tf-icons bx bx-power-off"></span>&nbsp; Keran Hidup</label>
                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                            autocomplete="off" />
                                        <label class="btn btn-outline-primary" for="btnradio2"><span
                                                class="tf-icons bx bx-power-off"></span>&nbsp; Keran Mati</label>
                                    </div> --}}
                                    </dl>
                                    </p>
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 order-3 order-md-4">
                                        <div class="row">
                                            <div class="text-center">
                                                <br>
                                                <br>
                                                Parameter Kolam
                                            </div>
                                            <br>
                                            <!-- pH -->
                                            <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div
                                                            class="card-title d-flex align-items-start justify-content-between">
                                                            <div class="avatar flex-shrink-0">
                                                                <img src="{{ asset('dashboard2/assets/img/icons/unicons/ph-balance.png') }}"
                                                                    alt="pH" class="rounded" />
                                                            </div>
                                                        </div>
                                                        <span class="d-block mb-1">pH</span>
                                                        <h3 class="card-title text-nowrap mb-2">
                                                            {{ $phValue ?? 'Data tidak tersedia' }}
                                                        </h3>

                                                        @if ($previousPhValue == null)
                                                            <small class="fw-semibold">
                                                                @if ($phValue < $previousPhValue)
                                                                    <i class="bx bx-down-arrow-alt"></i>
                                                                    <!-- Down arrow for lower value -->
                                                                @elseif($phValue > $previousPhValue)
                                                                    <i class="bx bx-up-arrow-alt"></i>
                                                                    <!-- Up arrow for higher value -->
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Suhu (Temperature) -->
                                            <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div
                                                            class="card-title d-flex align-items-start justify-content-between">
                                                            <div class="avatar flex-shrink-0">
                                                                <img src="{{ asset('dashboard2/assets/img/icons/unicons/thermometer.png') }}"
                                                                    alt="Temperature" class="rounded" />
                                                            </div>
                                                        </div>
                                                        <span class="fw-semibold d-block mb-1">Temperature</span>
                                                        <h3 class="card-title mb-2">
                                                            {{ $temperatureValue ?? 'Data tidak tersedia' }}°C
                                                        </h3>
                                                        @if ($previousTemperatureValue !== null)
                                                            <small class="fw-semibold">
                                                                @if ($temperatureValue < $previousTemperatureValue)
                                                                    <i class="bx bx-down-arrow-alt"></i>
                                                                    <!-- Down arrow for lower value -->
                                                                @elseif($temperatureValue > $previousTemperatureValue)
                                                                    <i class="bx bx-up-arrow-alt"></i>
                                                                    <!-- Up arrow for higher value -->
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- TDS -->
                                            <div class="col-2 mb-4 card-body pb-0 px-0 px-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div
                                                            class="card-title d-flex align-items-start justify-content-between">
                                                            <div class="avatar flex-shrink-0">
                                                                <img src="{{ asset('dashboard2/assets/img/icons/unicons/dissolved-oxygen-monitor.png') }}"
                                                                    alt="TDS" class="rounded" />
                                                            </div>
                                                        </div>
                                                        <span class="fw-semibold d-block mb-1">TDS</span>
                                                        <h3 class="card-title mb-2">
                                                            {{ $tdsValue ?? 'Data tidak tersedia' }}
                                                        </h3>
                                                        @if ($previousTdsValue !== null)
                                                            <small class="fw-semibold">
                                                                @if ($tdsValue < $previousTdsValue)
                                                                    <i class="bx bx-down-arrow-alt"></i>
                                                                    <!-- Down arrow for lower value -->
                                                                @elseif($tdsValue > $previousTdsValue)
                                                                    <i class="bx bx-up-arrow-alt"></i>
                                                                    <!-- Up arrow for higher value -->
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--/ Card layout -->
            </div>
        </div>
    </div>
    <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
