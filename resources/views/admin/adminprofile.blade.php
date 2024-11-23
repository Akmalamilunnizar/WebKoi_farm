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
                        <form method="POST" action="{{ route('storeprofile') }}" >
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset('uploads/users/' . Auth::user()->img) }}" alt="user-avatar"
                                        class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="image" class="btn btn-primary me-2 mb-4" tabindex="0"
                                            style="background: linear-gradient(135deg, #00FF00, #006400);">
                                            <span class="d-none d-sm-block">Unggah Foto</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                        </label>
                                        <input type="file" id="image" name="profile_image" class="account-file-input"
                                        style="display: none;" />
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <!-- Bagian Kiri -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Nama</label>
                                            <input class="form-control" type="text" id="firstName" name="firstName"
                                                value="{{ Auth::user()->f_name }}" autofocus />
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>

                                    <!-- Bagian Kanan -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="currentPassword" class="form-label">Password Saat Ini</label>
                                            <input type="password" class="form-control" id="currentPassword"
                                                name="currentPassword" placeholder="Masukkan password saat ini"
                                                maxlength="6" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control" id="newPassword" name="newPassword"
                                                placeholder="Masukkan password baru" maxlength="6" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="newPassword_confirmation"
                                                name="newPassword_confirmation" placeholder="Konfirmasi password baru"
                                                maxlength="6" />
                                        </div>

                                        <!-- Tombol Simpan -->
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary w-100"
                                                style="background: linear-gradient(135deg, #00FF00, #006400);">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden email and token fields (Optional) -->
                            {{-- <input type="hidden" name="custom_token" value="{{ $customToken }}"> --}}
                            {{-- <input type="hidden" name="email" value="{{ request()->query('email') }}" /> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
