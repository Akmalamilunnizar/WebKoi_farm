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
                <strong>Jenis Koi :</strong> {{ $koi->jenis_koi }}
            </div>
            <div class="mb-3">
                <strong>Penyakit :</strong> {{ $diagnosa->penyakit }}
            </div>
            <div class="mb-3">
                <strong>Penyebab :</strong> {{ $diagnosa->penyebab }}
            </div>
            <div class="mb-3">
                <strong>Gambar Koi Terdiagnosa:</strong><br>
                @if($diagnosa->gambar_koi)
                    <a href="{{ asset('storage/images/' . $diagnosa->gambar_koi) }}" target="_blank">
                        <img src="{{ asset('storage/images/' . $diagnosa->gambar_koi) }}" alt="Gambar Koi" height="150"
                            style="cursor: pointer;">
                    </a>
                @else
                    Tidak ada gambar
                @endif
            </div>
            <div class="mb-3">
                <strong>Keterangan :</strong> {{ $diagnosa->keterangan }}
            </div>
            <div class="mb-3">
                <strong>Kemungkinan Penyakit :</strong> <!-- {{ $diagnosa->keterangan }} -->
            </div>
            <a href="{{ route('allDiagnosaPenyakit') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
