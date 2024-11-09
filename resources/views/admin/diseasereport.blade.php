@extends('admin.layouts.template')
@section('page_title')
Laporan - Penyakit Ikan Koi
@endsection
@section('search')
<div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <form method="GET" action={{ route('searchusers') }}>
            <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                placeholder="Pencarian Id atau nama..." value="{{ isset($search) ? $search : '' }}"
                aria-label="Pencarian..." />
        </form>
    </div>
</div>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Laporan Parameter</h4>
    <div class="btn-group mb-3">
        <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            Kolam
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0);">Kolam 1</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Kolam 2</a></li>
            <li><a class="dropdown-item" href="javascript:void(0);">Kolam 3</a></li>
        </ul>
    </div>
    <div class="d-flex mb-3">
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                Bulan
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:void(0);">Januari</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Februari</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Maret</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">April</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Mei</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Juni</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Juli</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Agustus</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">September</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Oktober</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">November</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Desember</a></li>
            </ul>
        </div>
        <button type="button" class="btn btn-danger ms-auto">
            <i class="fas fa-file-pdf me-1"></i> Export PDF
        </button>
    </div>
    <div class="card">
        <h5 class="card-header">Daftar Data Penyakit Ikan Koi</h5>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Ikan</th>
                        <th>Jumlah Ikan Sakit</th>
                        <th>Presentase Ikan Sakit</th>
                        <th>Jenis Penyakit</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>1</td>
                        <td>02-11-2024</td>
                        <td>30</td>
                        <td>7</td>
                        <td>6%</td>
                        <td>Jamur Tiram</td>
                        <td>Disebabkan Oleh Jamur</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>02-11-2024</td>
                        <td>100</td>
                        <td>5</td>
                        <td>5%</td>
                        <td>Jamur Tiram</td>
                        <td>Disebabkan Oleh Jamur</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>02-11-2024</td>
                        <td>50</td>
                        <td>3</td>
                        <td>2%</td>
                        <td>Jamur Tiram</td>
                        <td>Gapernah Mandi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection