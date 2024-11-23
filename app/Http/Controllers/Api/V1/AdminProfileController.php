<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AdminProfileController extends Controller
{
    // Menampilkan daftar profil pengguna
    public function index()
    {
        $profile = Auth::user();
        return view('admin.adminprofile', compact('profile'));
    }

    // Mencari profil berdasarkan nama atau email
    public function SearchProfile(Request $request)
    {
        $search = $request->search;

        $users = User::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
            ->orWhere('f_name','like',"%$search%");

        })->get();

        return view('admin.adminprofile', compact('users', 'search'));
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
