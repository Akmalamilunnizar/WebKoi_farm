@extends('admin.layouts.template')

@section('page_title')
Detail Koi
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Detail Koi: {{ $koi->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <strong>ID Koi:</strong>
                        <p>{{ $koi->id }}</p>
                    </div>
                    <div class="col-sm-6">
                        <strong>Nama:</strong>
                        <p>{{ $koi->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <strong>Jenis Koi:</strong>
                        <p>{{ $koi->jenisKoi->name }}</p> <!-- pastikan 'jenisKoi' relasi ada -->
                    </div>
                    <div class="col-sm-6">
                        <strong>Tanggal Lahir:</strong>
                        <p>{{ $koi->tanggal_lahir }}</p>
                    </div>

                </div>
                <div class="col-sm-6">
                        <strong>Penyakit:</strong>
                        <p>
                            @if ($koi->penyakit && $koi->penyakit->count() > 0)
                                @foreach ($koi->penyakit as $penyakit)
                                    <span class="badge bg-danger">{{ $penyakit->nama_penyakit }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-success">Tidak Ada Penyakit</span>
                            @endif
                        </p>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <strong>Deskripsi:</strong>
                        <p>{{ $koi->description }}</p>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Gambar Koi</strong></p>
                                <p><img src="{{ asset('storage/' . $koi->img) }}" alt="Gambar Koi" class="img-fluid"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <strong>Tanggal Daftar:</strong>
                                <p>{{ $koi->created_at }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong>Tanggal Diperbarui:</strong>
                                <p>{{ $koi->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
