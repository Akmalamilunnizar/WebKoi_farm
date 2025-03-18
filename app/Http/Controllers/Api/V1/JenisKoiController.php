<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\JenisKoi;
use Illuminate\Http\Request;

class JenisKoiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input: cek apakah nama sudah ada di database
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:jenis_koi,name', // pastikan 'jenis_koi' adalah nama tabel yang benar
        ]);

        JenisKoi::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Jenis Koi berhasil ditambahkan.');
    }
}
