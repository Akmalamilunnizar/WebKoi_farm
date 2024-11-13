@extends('admin.layouts.template')
@section('page_title')
Daftar Ikan Koi
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
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Ikan Koi</h5>
            <a href="{{ route('adddaftarkoi') }}" class="btn btn-primary ms-auto">
                + Tambah Data Baru
            </a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id Koi</th>
                    <th>Jenis Koi</th>
                    <th>Umur Ikan</th>
                    <th>Tanggal Daftar</th> <!-- Kolom baru untuk Tanggal Daftar -->
                    <th>Status</th>
                    <th>Kolam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>IK001</td>
                    <td>Kohaku</td>
                    <td>2 tahun</td>
                    <td>2023-01-15</td> <!-- Nilai contoh untuk Tanggal Daftar -->              
                    <td><span class="badge bg-label-success me-1">Sehat</span></td>
                    <td>Kolam 1</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-detail me-1"></i> Detail</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>IK002</td>
                    <td>Sanke</td>
                    <td>1.5 tahun</td>
                    <td>2023-03-20</td> <!-- Nilai contoh untuk Tanggal Daftar -->           
                    <td><span class="badge bg-label-danger me-1">Sakit</span></td>
                    <td>Kolam 2</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
