@extends('admin.layouts.template')
@section('page_title')
    All Product - Single Ecom
@endsection
@section('search')
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <form method="GET" action={{ route('searchpond') }}>
                <input type="text" name="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 w-100"
                    placeholder="Pencarian id atau nama..." value="{{ isset($search) ? $search : '' }}" aria-label="Pencarian..." style="600px" />
            </form>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Semua Kolam</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Kolam Yang Tersedia</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nama Kolam</th>
                            <th>Volume</th>
                            <th>Gambar</th>
                            <th>Jumlah Ikan</th>
                            <th>Kondisi Keran</th>
                            <th>Dibuat Pada</th>
                            <th>Update Pada</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($ponds as $pond)
                            <tr>
                                <td>{{ $pond->id }}</td>
                                <td>{{ $pond->name }}</td>
                                <td>{{ $pond->volume }}</td>


                                <td>
                                    <img style="width: 138px" src="/uploads/{{ $pond->img }}" alt="">
                                    <br>
                                    <a href="{{ route('editpondimg', $pond->id) }}" class="btn btn-primary">Update Gambar</a>
                                </td>
                                <td>{{ $jml_ikan }}</td>
                                <td>{{ $pond->relay_condition }}</td>
                                <td>{{ $pond->created_at }}</td>
                                <td>{{ $pond->updated_at }}</td>
                                <td>
                                    <a href="{{ route('editpond', $pond->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deletepond', $pond->id) }}" class="btn btn-warning">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
@endsection
