<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KoiFish;
use App\Models\JenisKoi;
use App\Models\Penyakit;
use App\Models\DiagnosaPenyakit;
use App\Models\Pond;
use Illuminate\Support\Facades\DB;


class DaftarKoiController extends Controller
{
    // List all Koi Fish with relationships and calculated age
    public function Index()
    {
        // Retrieve koi fishes with calculated age (years and months) and related data
        $koiFishes = KoiFish::selectRaw("
            *,
            CASE
                WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 1 THEN
                    CONCAT(TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()), ' tahun')
                ELSE
                    CONCAT(TIMESTAMPDIFF(MONTH, tanggal_lahir, CURDATE()), ' bulan')
            END AS umur
        ")
            ->with(['jenisKoi', 'penyakit', 'ponds'])
            ->get();

        return view('admin.daftarkoi', compact('koiFishes'));
    }



    // Add a new Koi Fish
    public function addDaftarKoi(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($request->all());
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'jenis_koi' => 'required|exists:jenis_koi,id',
                'tanggal_lahir' => 'nullable|date',
                'img' => 'required|image',
                'penyakit' => 'nullable|exists:penyakit,id',
                // 'gender' => 'required|in:Jantan,Betina',
                'kolam' => 'required|exists:ponds,id',
            ]);

            $koi = new KoiFish();
            $koi->name = $validated['name'];
            $koi->jenis_koi = $validated['jenis_koi'];
            $koi->tanggal_lahir = $validated['tanggal_lahir'];
            // $koi->gender = $request->input('gender');

            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('images/koi', 'public');
                $koi->img = $path;
            }

            $koi->save();
            // Insert ke tabel detail_koi
            DB::table('detail_koi')->insert([
                'fish_id' => $koi->id,
                'pond_id' => $validated['kolam'],
            ]);

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
        $kolamOptions = Pond::all();


        return view('admin.adddaftarkoi', compact('penyakitOptions', 'kolamOptions','jenisKoiOptions'));
    }


    // Edit Koi Fish details
    public function edit($id)
    {
        $koi = KoiFish::findOrFail($id);
        $jenisKoiOptions = JenisKoi::all();

        return view('admin.editDaftarKoi', compact('koi', 'jenisKoiOptions'));
    }

    // Update Koi Fish details
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jenis_koi' => 'required|exists:jenis_koi,id',
            'img' => 'nullable|image',
            'penyakit' => 'nullable|exists:penyakit,id',
            'kolam' => 'required',
            // 'gender' => 'required|in:Jantan,Betina',
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


    // Delete a Koi Fish
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


    // Show details of a specific Koi Fish
    public function show($id)
    {
        $koi = KoiFish::with(['jenisKoi', 'diagnosaPenyakit.penyakit'])->findOrFail($id);
        return view('admin.detailDaftarKoi', compact('koi'));
    }


    // Add a new disease
    public function addPenyakit(Request $request)
    {
        $validated = $request->validate([
            'nama_penyakit' => 'required|string|max:255|unique:penyakit,nama_penyakit',
        ]);

        $penyakit = new Penyakit($validated);
        $penyakit->save();

        return redirect()->back()->with('success', 'Penyakit berhasil ditambahkan!');
    }

    // Get a list of Koi Fish (API)
    public function get_koi_list()
    {
        $kois = KoiFish::with(['jenisKoi', 'penyakit'])->get();

        return response()->json([
            'message' => 'Data koi berhasil didapatkan',
            'data' => $kois
        ]);
    }


    // Get Koi Fish by Pond ID (API)
    public function getKoiByPondId(Request $request)
    {
        $pondId = $request->query('pondId');

        if (!$pondId) {
            return response()->json(['message' => 'pondId is required'], 400);
        }

        // Assuming you have a 'ponds' relationship in the KoiFish model
        $kois = KoiFish::whereHas('ponds', function ($query) use ($pondId) {
            $query->where('pond_id', $pondId);  // Make sure this matches the foreign key column
        })
            ->with(['jenisKoi', 'diagnosaPenyakit.penyakit'])  // Include related models
            ->get();

        if ($kois->isEmpty()) {
            return response()->json(['message' => 'No koi fish found for the specified pond'], 404);
        }

        return response()->json([
            'message' => 'Data koi successfully fetched',
            'data' => $kois,
        ]);
    }
}
