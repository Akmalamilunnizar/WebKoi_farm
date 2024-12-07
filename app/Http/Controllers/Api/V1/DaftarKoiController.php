<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KoiFish;  // Import model KoiFish
use App\Models\JenisKoi;
use App\Models\Penyakit;

class DaftarKoiController extends Controller
{

    // //
    // public function index()
    // {
    //     return view('admin.daftarkoi');
    // }

    public function index()
    {
        // $koiFishes = KoiFish::all();  // Mengambil semua data dari tabel koi_fish

        // Mengambil data koi dengan relasi jenisKoi dan penyakit
        $koiFishes = KoiFish::with(['jenisKoi', 'penyakit'])->get();  // Mengambil semua data dengan relasi
        return view('admin.daftarkoi', compact('koiFishes'));
    }
    //     public function addDaftarKoi(Request $request)
    // {
    //     $jenisKoiOptions = JenisKoi::all();
    //     return view('admin.adddaftarkoi', compact('jenisKoiOptions'));

    //     if ($request->isMethod('post')) {f
    //         // Proses data form (misalnya validasi dan menyimpan ke database)
    //         $validated = $request->validate([
    //             'id_koi' => 'required',
    //             'created_at' => 'required|date',
    //             'jenis_koi' => 'required',
    //             // 'status' => 'required|in:Sehat,Sakit',
    //             'gambar_koi' => 'required|image',
    //             'keterangan' => 'nullable|string',
    //             'tanggal_lahir' => 'nullable|date',  // Menjadikan tanggal lahir opsional
    //             'umur' => 'nullable|integer',  // Menjadikan umur opsional
    //         ]);

    //         // Setelah berhasil menyimpan, redirect ke halaman daftar koi
    //         return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil ditambahkan!');
    //     }

    //     // Jika tidak ada data yang dikirim (GET request), tampilkan form
    //     return view('admin.addDaftarKoi');
    // }
    public function addDaftarKoi(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validasi data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'jenis_koi' => 'required',
                'tanggal_lahir' => 'nullable|date',
                'umur' => 'nullable|integer',
                'created_at' => 'required|date',
                'img' => 'required|image',
                // 'id_penyakit' => 'required|string',
                'penyakit' => 'required|exists:penyakit,id', // Validasi id penyaki
                'description' => 'required|string',
            ]);

            // Simpan data ke database
            $koi = new KoiFish();
            $koi->name = $validated['name'];
            $koi->jenis_koi = $validated['jenis_koi'];
            $koi->tanggal_lahir = $validated['tanggal_lahir'];
            $koi->umur = $validated['umur'];
            $koi->created_at = $validated['created_at'];
            $koi->id_penyakit = $validated['penyakit'];

            // Simpan file gambar
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('images/koi', 'public');
                $koi->img = $path;
            }

            $koi->save();

            return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil ditambahkan!');
        }

        // Ambil data penyakit dan jenis koi untuk dropdown
        $penyakitOptions = Penyakit::all();
        $jenisKoiOptions = JenisKoi::all();

        return view('admin.adddaftarkoi', compact('penyakitOptions', 'jenisKoiOptions'));
    }
    public function edit($id)
    {
        // Temukan data koi berdasarkan ID
        $koi = KoiFish::findOrFail($id);
        // Ambil data jenis koi untuk dropdown
        $jenisKoiOptions = JenisKoi::all();

        // Kembalikan ke view dengan data koi dan jenis koi
        return view('admin.editDaftarKoi', compact('koi', 'jenisKoiOptions'));

        // // Kembalikan ke view dengan data koi
        // return view('admin.editDaftarKoi', compact('koi'));

    }
    public function destroy($id)
    {
        // Temukan data koi berdasarkan ID
        $koi = KoiFish::findOrFail($id);

        // Hapus data koi
        $koi->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil dihapus!');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'jenis_koi' => 'required',
            // Tambahkan validasi lainnya
        ]);

        // Temukan koi berdasarkan ID
        $koi = KoiFish::findOrFail($id);

        // Update data koi
        $koi->name = $request->input('name');
        $koi->jenis_koi = $request->input('jenis_koi');
        $koi->tanggal_lahir = $request->input('tanggal_lahir');
        $koi->umur = $request->input('umur');
        $penyakit = Penyakit::where('nama_penyakit', 'White Spot')->first();
        $koi->id_penyakit = $penyakit->id; // Set ID penyakit
        $koi->description = $request->input('description');

        // Jika ada gambar baru, simpan gambar tersebut
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('images/koi', 'public');
            $koi->img = $path;
        }

        // Simpan perubahan
        $koi->save();

        // Redirect ke halaman daftar koi dengan pesan sukses
        return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil diperbarui!');
    }

    public function show($id)
    {
        // Ambil data koi berdasarkan ID
        $koi = KoiFish::findOrFail($id);
        return view('admin.detailDaftarKoi', compact('koi'));
    }

    // Fungsi untuk menambahkan penyakit baru
    public function addPenyakit(Request $request)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:255|unique:penyakit,nama_penyakit',
            // 'description' => 'nullable|string'
        ]);

        // Cek apakah penyakit dengan nama yang sama sudah ada
        $penyakitExist = Penyakit::where('nama_penyakit', $request->nama_penyakit)->first();
        if ($penyakitExist) {
            return redirect()->back()->with('error', 'Penyakit dengan nama ini sudah ada!');
        }
        $penyakit = new Penyakit();
        $penyakit->nama_penyakit = $request->nama_penyakit;
        // $penyakit->description = $request->description;
        $penyakit->save();

        return redirect()->back()->with('success', 'Penyakit berhasil ditambahkan!');
    }

    public function get_koi_list()
    {
        // Logika untuk mendapatkan data koi
        $kois = KoiFish::all();
        $kois = KoiFish::with(['jenisKoi', 'penyakit'])->get();

        return response()->json([
            'message' => 'Data koi berhasil didapatkan',
            'data' => $kois
            // data lainnya
        ]);
    }

    public function getKoiByPondId(Request $request)
    {
        $pondId = $request->query('pondId');  // Get the pondId from the query string

        if (!$pondId) {
            return response()->json(['message' => 'pondId is required'], 400);
        }

        // Assuming you have a 'ponds' relationship in the KoiFish model
        $kois = KoiFish::whereHas('ponds', function($query) use ($pondId) {
            $query->where('ponds.id', $pondId);  // Filter koi fish by pondId
        })
        ->with(['jenisKoi', 'penyakit'])  // Include related models
        ->get();

        if ($kois->isEmpty()) {
            return response()->json(['message' => 'No koi fish found for the specified pond'], 404);
        }

        return response()->json([
            'message' => 'Data koi successfully fetched',
            'data' => $kois
        ]);
    }
}
