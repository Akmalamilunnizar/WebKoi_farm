@extends('admin.layouts.template')
@section('page_title')
    Detail Diagnosa Penyakit - Restorant
@endsection
@section('css')
    <style>
        img:hover {
            opacity: 0.8;
            transition: 0.3s;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Halaman/</span> Detail Diagnosa Penyakit</h4>

        <div class="card">
            <h5 class="card-header">Detail Ikan Koi</h5>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Jenis Koi :</strong>
                    {{ $diagnosa->koiFish->jenisKoi ? $diagnosa->koiFish->jenisKoi->name : 'Jenis tidak tersedia' }}
                </div>

                <div class="mb-3">
                    <strong>Penyakit :</strong> {{ $diagnosa->penyakit->nama_penyakit }}
                </div>
                <div class="mb-3">
                    <strong>Gambar Koi Terdiagnosa:</strong><br>
                    @if ($diagnosa->gambar_koi)
                        <a href="{{ asset($diagnosa->gambar_koi) }}" target="_blank">
                            <img src="{{ asset($diagnosa->gambar_koi) }}" alt="Gambar Koi" height="150"
                                style="cursor: pointer;">
                        </a>
                    @else
                        Tidak ada gambar
                    @endif
                </div>
                <div class="mb-3">
                    <strong>Keterangan :</strong> {{ $diagnosa->penyakit->description }}
                </div>
                <a href="{{ route('allDiagnosaPenyakit') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

