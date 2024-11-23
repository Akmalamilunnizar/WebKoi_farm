@extends('admin.layouts.template')
@section('page_title')
SANKE | Halaman Daftar Ikan Koi
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
    <a href="{{ route('adddaftarkoi') }}" class="btn btn-success ms-auto"
        style="background: linear-gradient(45deg, #28a745, #34d058);">
        + Tambah Koi
    </a>
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Daftar Ikan Koi</h5>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Koi</th>
                    <th>Jenis Koi</th>
                    <th>Tanggal Lahir</th>
                    <th>Kolam</th>
                    <th>Umur Ikan</th>
                    <th>Tanggal Daftar</th>
                    <th>Penyakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($koiFishes as $fish)
                    <tr>
                        <td>{{ $fish->id }}</td>
                        <td>{{ $fish->name }}</td>
                        <td>{{ $fish->jenisKoi ? $fish->jenisKoi->name : 'Jenis tidak tersedia' }}</td>
                        <td>{{ $fish->tanggal_lahir }}</td>
                        <td>{{ $fish->ponds->first()?->name }}</td>
                        <td>{{ $fish->umur }} tahun</td>
                        <td>{{ $fish->created_at }}</td>
                        <td>{{ $fish->penyakit ? $fish->penyakit->nama_penyakit : 'Penyakit tidak tersedia' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('koi.detail', $fish->id) }}"><i
                                            class="bx bx-detail me-1"></i> Detail</a>
                                    <a class="dropdown-item" href="{{ route('koi.edit', $fish->id) }}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <form action="{{ route('koi.delete', $fish->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            style="background: none; border: none; color: inherit;">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
