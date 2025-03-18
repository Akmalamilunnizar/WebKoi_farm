@extends('admin.layouts.template')

@section('page_title')
Edit Daftar Koi
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Daftar Koi</h5>
                <small class="text-muted float-end">Edit Informasi Koi</small>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('koi.update', $koi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $koi->name }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="jenis_koi">Jenis Koi</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="jenis_koi" name="jenis_koi" required>
                                <option value="">Pilih Jenis Koi</option>
                                @foreach($jenisKoiOptions as $jenis)
                                    <option value="{{ $jenis->id }}" {{ $koi->jenis_koi == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ $koi->tanggal_lahir }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="umur">Umur Koi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="umur" name="umur" value="{{ $koi->umur }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="created_at">Tanggal Daftar</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="created_at" name="created_at"
                                value="{{ $koi->created_at }}" required readonly />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="img">Gambar Koi</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="img" name="img" />
                            @if($koi->img)
                                <img src="{{ asset('storage/' . $koi->img) }}" alt="Gambar Koi" class="mt-2"
                                    style="max-width: 100px;">
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="penyakit">Penyakit</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <select class="form-control" id="penyakit" name="penyakit" required>
                                    <option value="">Pilih Penyakit</option>
                                    @foreach ($penyakitOptions as $penyakit)
                                        <option value="{{ $penyakit->id }}" {{ $koi->penyakit->isNotEmpty() && $koi->penyakit->first()->id == $penyakit->id ? 'selected' : '' }}>
                                            {{ $penyakit->nama_penyakit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update Data Koi</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection