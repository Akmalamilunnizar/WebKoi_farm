<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KoiFish;
use App\Models\JenisKoi;
use App\Models\Penyakit;
use App\Models\DiagnosaPenyakit;

class DaftarKoiController extends Controller
{
    public function index()
    {
        // Mengambil data koi beserta jenis dan penyakit (melalui diagnosa)
        $koiFishes = KoiFish::with(['jenisKoi', 'diagnosaPenyakit.penyakit'])->get();
        return view('admin.daftarkoi', compact('koiFishes'));
    }

    public function addDaftarKoi(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'jenis_koi' => 'required|exists:jenis_koi,id',
                'tanggal_lahir' => 'nullable|date',
                'img' => 'required|image',
                'penyakit' => 'nullable|exists:penyakit,id',
            ]);

            $koi = new KoiFish();
            $koi->name = $validated['name'];
            $koi->jenis_koi = $validated['jenis_koi'];
            $koi->tanggal_lahir = $validated['tanggal_lahir'];

            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('images/koi', 'public');
                $koi->img = $path;
            }

            $koi->save();

            // Jika ada penyakit, tambahkan ke diagnosa
            if (!empty($validated['penyakit'])) {
                DiagnosaPenyakit::create([
                    'id_koi' => $koi->id,
                    'id_penyakit' => $validated['penyakit'],
                ]);
            }

            return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil ditambahkan!');
        }

        $penyakitOptions = Penyakit::all();
        $jenisKoiOptions = JenisKoi::all();

        return view('admin.adddaftarkoi', compact('penyakitOptions', 'jenisKoiOptions'));
    }

    public function edit($id)
    {
        $koi = KoiFish::findOrFail($id);
        $jenisKoiOptions = JenisKoi::all();
        $penyakitOptions = Penyakit::all();

        return view('admin.editDaftarKoi', compact('koi', 'jenisKoiOptions', 'penyakitOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jenis_koi' => 'required|exists:jenis_koi,id',
            'img' => 'nullable|image',
            'penyakit' => 'nullable|exists:penyakit,id',
        ]);

        $koi = KoiFish::findOrFail($id);
        $koi->name = $request->input('name');
        $koi->jenis_koi = $request->input('jenis_koi');

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('images/koi', 'public');
            $koi->img = $path;
        }

        $koi->save();

        // Update diagnosa penyakit
        DiagnosaPenyakit::updateOrCreate(
            ['id_koi' => $koi->id],
            ['id_penyakit' => $request->input('penyakit')]
        );

        return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $koi = KoiFish::findOrFail($id);

        // Hapus data pivot di tabel detail_koi
        $koi->ponds()->detach();

        // Hapus diagnosa terkait (opsional, jika diperlukan)
        DiagnosaPenyakit::where('id_koi', $id)->delete();

        // Hapus data ikan koi
        $koi->delete();

        return redirect()->route('daftarkoi')->with('success', 'Data koi berhasil dihapus!');
    }


    public function show($id)
    {
        $koi = KoiFish::with(['jenisKoi', 'diagnosaPenyakit.penyakit'])->findOrFail($id);
        return view('admin.detailDaftarKoi', compact('koi'));
    }
}
