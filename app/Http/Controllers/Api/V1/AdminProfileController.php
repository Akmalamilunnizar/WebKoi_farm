<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminProfileController extends Controller
{
    // Menampilkan daftar profil pengguna
    public function index()
    {
        $profiles = User::all();
        return view('admin.adminprofile', compact('profiles'));
    }

    // Mencari profil berdasarkan nama atau email
    public function SearchProfile(Request $request)
    {
        $search = $request->search;

        $users = User::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
            ->orWhere('f_name','like',"%$search%");

        })->get();

        return view('admin.allusers', compact('users', 'search'));
    }


    // Memperbarui data profil
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'email_verified_at' => 'date',
        ]);

        $profile = User::findOrFail($id);
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');

        if ($request->filled('password')) {
            $profile->password = bcrypt($request->input('password'));
        }

        $profile->save();

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil diperbarui');
    }




    // Menghapus profil
    public function destroy($id)
    {
        $profile = User::findOrFail($id);
        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profil berhasil dihapus');
    }
}
