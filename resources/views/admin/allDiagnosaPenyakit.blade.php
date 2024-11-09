@extends('admin.layouts.template')
@section('page_title')
Daftar Diagnosa Penyakit - Restorant
@endsection

@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action="{{ route('searchdiagnosa') }}">
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Pencarian jenis koi atau penyakit..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..." />
            </form>
        </div>
    </div>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Daftar Diagnosa Penyakit</h4>

    <div class="card">
        <h5 class="card-header">Diagnosa Penyakit Yang Tersedia</h5>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Jenis Koi</th>
                <th>Penyakit</th>
                <th>Penyebab</th>
                <th>Gambar Koi Terdiagnosa</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($diagnosas as $key => $diagnosa)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $diagnosa->jenis_koi }}</td>
                <td>{{ $diagnosa->penyakit }}</td>
                <td>{{ $diagnosa->penyebab }}</td>
                <td>
                  @if($diagnosa->gambar_koi)
                    <img src="{{ asset('storage/' . $diagnosa->gambar_koi) }}" alt="Gambar Koi" width="50">
                  @else
                    Tidak ada gambar
                  @endif
                </td>
                <td>{{ $diagnosa->keterangan }}</td>
                <td>
                    <a href="{{ route('editdiagnosa', $diagnosa->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('admin/delete-diagnosa/' . $diagnosa->id) }}" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection
