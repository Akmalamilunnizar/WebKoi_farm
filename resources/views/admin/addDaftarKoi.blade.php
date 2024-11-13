@extends('admin.layouts.template')
@section('page_title')
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-1"><span class="text-muted fw-light">Halaman/</span> Tambah Daftar Koi</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Daftar Koi</h5>
            <small class="text-muted float-end">Input Informasi</small>
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
            <form action="{{ route('adddaftarkoi') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="id_koi">ID Koi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="id_koi" name="id_koi" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jenis_koi">Jenis Koi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jenis_koi" name="jenis_koi" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Lahir</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jenis_koi">Umur Ikan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jenis_koi" name="jenis_koi" required />
                </div>
              </div>       


              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jenis_koi">Kolam</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jenis_koi" name="jenis_koi" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Daftar</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="gambar_koi">Gambar Koi</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="gambar_koi" name="gambar_koi" required />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="status">Status</label>
                <div class="col-sm-10">
                  <select class="form-control" id="status" name="status" required>
                    <option value = "">Pilih Status</option>
                    <option value = "Sehat">Sehat</option>
                    <option value = "Sakit">Sakit</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="keterangan">Penyakit</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder = "Jika Status Sakit, Tuliskan Penyakit, Jika Sehat, Tuliskan -" required></textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder = "Tidak aktif berenang, cenderung diam di dasar kolam. " required></textarea>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Tambah Data Koi</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
