<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\DiagnosaPenyakit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class PcvController extends Controller
{
    // Menampilkan daftar profil pengguna
    public function Index()
    {
        // $profile = Auth::user();
        return view('admin.pcv');
    }

    public function ResultNodb(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'imagefile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Get the uploaded file
        $file = $request->file('imagefile');

        $data = $request->all();
        $data = $request->except('_token');
        $response = Http::post('http://127.0.0.1/predict', $data);
        if ($response->successful()) {
            $predictedDisease = $response->json()['Predicted Disease'] ?? null;
            if ($predictedDisease !== null) {
                return $predictedDisease;
            } else {
                return response()->json(['error' => 'Failed'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to predict '], $response->status());
        }
        // Prepare the file for storing
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = public_path('uploads');
        $file->move($filePath, $fileName);
        $uploadedFilePath = '/uploads/' . $fileName;

        // try {
        //     // Send the image to the Flask API
        //     $response = Http::attach(
        //         'imagefile',
        //         file_get_contents($file->getRealPath()),
        //         $fileName
        //     )->post('http://127.0.0.1:5000/predict'); // Update URL if necessary

        //     // Handle API response
        //     if ($response->successful()) {
        //         $data = $response->json();

        //         // Extract prediction data from Flask response
        //         $prediction = $data['prediction'];
        //         $classes_with_percentages = $data['probabilities'];
        //         $image_url = $uploadedFilePath; // Use local uploaded path for consistency

        //         // Save diagnosis data to the database
        //         DiagnosaPenyakit::create([
        //             'tanggal' => now(),
        //             'jenis_koi' => 'N/A', // Replace with user input if available
        //             'penyakit' => $prediction,
        //             'penyebab' => json_encode($classes_with_percentages),
        //             'gambar_koi' => $uploadedFilePath,
        //             'keterangan' => 'Diagnosis berhasil.', // Modify if needed
        //         ]);

        //         // Return the view with prediction data
        //         return view('admin.pcv', compact('prediction', 'classes_with_percentages', 'image_url'));
        //     } else {
        //         // Handle unsuccessful API response
        //         return back()->withErrors(['error' => 'Failed to get prediction from the model.']);
        //     }
        // } catch (\Exception $e) {
        //     // Handle exceptions
        //     return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        // }
    }



    public function Result(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'imagefile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the uploaded file
        $file = $request->file('imagefile');

        // Validate the file's existence and upload status
        if (!$file->isValid()) {
            return back()->withErrors(['error' => 'Invalid file upload.']);
        }

        // Send the file to the Flask API
        try {
            $response = Http::attach(
                'imagefile',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:5000/predict'); // Ensure the URL matches your Flask API endpoint

            if ($response->successful()) {
                // Extract response data
                $data = $response->json();
                $prediction = $data['prediction'];
                $probabilities = $data['probabilities'];
                $imageUrl = $data['image_url'];

                // Optionally, store the result in the database
                DiagnosaPenyakit::create([
                    'jenis_koi' => 'N/A', // Replace with actual value if needed
                    'penyakit' => $prediction,
                    'penyebab' => json_encode($probabilities),
                    'gambar_koi' => $imageUrl,
                    'keterangan' => 'Diagnosis completed successfully.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Return the response to the view
                return view('admin.pcv', [
                    'prediction' => $prediction,
                    'classes_with_percentages' => $probabilities,
                    'image_url' => $imageUrl,
                ]);
            } else {
                return response()->json(['error' => 'Failed to predict'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error connecting to Flask API: ' . $e->getMessage()], 500);
        }
    }



    // edit profile for web
    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'email_verified_at' => 'date',
            'currentPassword' => 'nullable|min:6', // Ensure current password is provided
            'newPassword' => 'nullable|min:6|confirmed', // Ensure new password matches confirmation
        ]);

        // $profile = User::findOrFail($id);
        // Check if the user wants to change the password
        if ($request->filled('newPassword')) {
            // Verify current password
            if (!Hash::check($request->input('currentPassword'), $profile->password)) {
                return redirect()->back()->withErrors(['currentPassword' => 'Password saat ini tidak valid.']);
            }

            // Update the password
            $profile->password = bcrypt($request->input('newPassword'));
        }

        if ($request->hasFile('img')) {
            $request->validate([
                'img' => 'required|image|mimes:png,jpg,gif,jpeg',
            ]);

            $del = 'uploads/users/' . $profile->img;
            if (File::exists($del)) {
                File::delete($del);
            }

            $file = $request->file('img');
            $exe = $file->getClientOriginalExtension();
            $filename = '_profile' . microtime() . '.' . $exe;
            $file->move('uploads/users/', $filename);
            $profile->img = $filename;
        }

        $profile->save();
        Log::info('Store Profile Request:', $request->all());

        return redirect()->route('admin.profiles')->with('success', 'Profil berhasil diperbarui');
    }


    // Menghapus profil
    public function destroy($id)
    {
        $profile = User::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil dihapus');
    }
}