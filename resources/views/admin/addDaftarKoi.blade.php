@extends('admin.layouts.template')
@section('page_title')
    Tambah Daftar Ikan Koi
    Tambah Daftar Ikan Koi
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
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

                        <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_koi">ID Koi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="id" name="id" required />
                        </div>
                      </div> -->

                        <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="jenis_koi">Jenis Koi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="jenis" name="jenis" required />
                        </div>
                      </div> -->

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" rows="3"
                                    required></input>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="jenis_koi">Jenis Koi</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="form-control" id="jenis_koi" name="jenis_koi" required>
                                        <option value="">Pilih Jenis Koi</option>
                                        @foreach ($jenisKoiOptions as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#addJenisKoiModal">Add New</button>
                                </div>
                            </div>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="gender">Gender</label>
    <div class="col-sm-10">
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Pilih Gender</option>
            <option value="Jantan">Jantan</option>
            <option value="Betina">Betina</option>
        </select>
    </div>
</div> --}}


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="kolam">Kolam</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="form-control" id="kolam" name="kolam" required>
                                        <option value="">Pilih Kolam</option>
                                        @foreach ($kolamOptions as $kolam)
                                            <option value="{{ $kolam->id }}">{{ $kolam->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#addKolamModal">Add New</button>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>



                        <!-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="umur">Umur Koi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="umur" name="umur" value="{{ old('umur') }}">
                            </div>
                        </div> -->


                        <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="kolam">Kolam</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="kolam" name="kolam" required />
                        </div>
                      </div> -->

                        <!-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Dibuat</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="created_at" name="created_at" required />
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="img">Gambar Koi</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="img" name="img" required />
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="status" name="status" required>
                            <option value = "">Pilih Status</option>
                            <option value = "Sehat">Sehat</option>
                            <option value = "Sakit">Sakit</option>
                          </select>
                        </div>
                      </div> -->

                        <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_penyakit">Penyakit</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="id_penyakit" name="id_penyakit" rows="3"
                              placeholder = "Tulisan jenis penyakitnya jika sakit, jika sehat tuliskan -" required></textarea>
                        </div>
                      </div> -->

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="penyakit">Penyakit</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="form-control" id="penyakit" name="penyakit">
                                        <option value="">Pilih Penyakit (Kosongkan jika tidak ada)</option>
                                        @foreach ($penyakitOptions as $penyakit)
                                            <option value="{{ $penyakit->id }}">{{ $penyakit->nama_penyakit }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#addPenyakitModal">Add New</button>
                                </div>
                            </div>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


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
    <!-- Modal Jenis Koi-->
    <div class="modal fade" id="addJenisKoiModal" tabindex="-1" aria-labelledby="addJenisKoiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('addJenisKoi') }}" method="POST" id="addJenisKoiForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJenisKoiLabel">Add New Jenis Koi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="jenis_name" class="form-label">Jenis Koi</label>
                            <input type="text" class="form-control" id="jenis_name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <!-- Modal untuk menambah penyakit -->
    <div class="modal fade" id="addPenyakitModal" tabindex="-1" aria-labelledby="addPenyakitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('addPenyakit') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPenyakitModalLabel">Tambah Penyakit Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_penyakit">Nama Penyakit</label>
                            <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                                <label for="description">Deskripsi Penyakit</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal untuk menambah Kolam -->
    <div class="modal fade" id="addKolamModal" tabindex="-1" aria-labelledby="addKolamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('addKolam') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKolamModalLabel">Tambah Kolam Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_kolam">Nama Kolam</label>
                            <input type="text" name="nama_kolam" id="nama_kolam" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
