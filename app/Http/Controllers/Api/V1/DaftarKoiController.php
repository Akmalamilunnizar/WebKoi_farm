<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KoiFish;  // Import model KoiFish

class DaftarKoiController extends Controller
{
    // //
    // public function index()
    // {
    //     return view('admin.daftarkoi');
    // }

    public function index()
    {
        $koiFishes = KoiFish::all();  // Mengambil semua data dari tabel koi_fish
        return view('admin.daftarkoi', compact('koiFishes'));
    }
    public function addDaftarKoi(Request $request)
{
    if ($request->isMethod('post')) {
        // Proses data form (misalnya validasi dan menyimpan ke database)
        $validated = $request->validate([
            'id_koi' => 'required',
            'tanggal' => 'required|date',
            'jenis_koi' => 'required',
            'status' => 'required|in:Sehat,Sakit',
            'gambar_koi' => 'required|image',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data ke database, atau lakukan proses lainnya
        // Misalnya, jika Anda menggunakan model DaftarKoi:
        // DaftarKoi::create($validated);

        // Setelah berhasil menyimpan, redirect ke halaman daftar koi
        return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil ditambahkan!');
    }

    // Jika tidak ada data yang dikirim (GET request), tampilkan form
    return view('admin.addDaftarKoi');
}

    
}
