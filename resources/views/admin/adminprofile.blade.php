@extends('admin.layouts.template')
@section('page_title')
SANKE | Halaman Ubah Profil Admin
@endsection
@section('search')
<div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <form method="GET" action={{ route('searchusers') }} class="d-inline-block ms-2">
            <input type="text" name="search" class="form-control border-0 shadow-none ps-2"
                placeholder="Pencarian Id atau nama..." value="{{ isset($search) ? $search : '' }}"
                aria-label="Pencarian..." />
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"
                            style="background: linear-gradient(135deg, #00FF00, #006400);">
                            <i class="bx bx-user me-1"></i> Akun Admin
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Detail Profil</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('Template') }}/sneat-1.0.0/assets/img/avatars/1.png" alt="user-avatar"
                                class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0"
                                    style="background: linear-gradient(135deg, #00FF00, #006400);">
                                    <span class="d-none d-sm-block">Unggah Foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4"
                                    style="background: linear-gradient(135deg, #FF4C4C, #8B0000); color: white;">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Hapus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
        <!-- Bagian Kiri -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstName" class="form-label">Nama</label>
                <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="john.doe@example.com"
                    placeholder="john.doe@example.com" />
            </div>
            <!-- Tombol Simpan di bawah Email -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100"
                    style="background: linear-gradient(135deg, #00FF00, #006400);">
                    Simpan
                </button>
            </div>
        </div>

        <!-- Bagian Kanan -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Password Saat Ini</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                    placeholder="Masukkan password saat ini" maxlength="6" />
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword"
                    placeholder="Masukkan password baru" maxlength="6" />
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                    placeholder="Konfirmasi password baru" maxlength="6" />
            </div>
            <!-- Tombol Simpan di bawah Konfirmasi Password -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary w-100"
                    style="background: linear-gradient(135deg, #00FF00, #006400);">
                    Simpan
                </button>
            </div>
        </div>
    </div>
                        </form>
                    </div>

                    @endsection