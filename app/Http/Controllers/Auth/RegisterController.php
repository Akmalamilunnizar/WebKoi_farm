<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |------------------------------------------------------------x--------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait 
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(Request $request)
    {
        // Buat validasi
        $validatedData = $request->validate([
            'f_name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed', // pw harus cocok dengan konfirmasi
            'password_confirmation' => 'required',
            'phone' => 'required|numeric',
        ]);
        
        try {
            // Buat user baru
            $user = User::create([
                'f_name' => $request->f_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone
            ]);

            // Simpan user
            $user->save();

            // Set flash message untuk pendaftaran berhasil
            Session::flash('success', 'Pendaftaran berhasil! Silakan masuk.');

            // Redirect ke halaman login
            return redirect('login');
        } catch (QueryException $e) {
            // Set flash message jika terjadi error pada database
            Session::flash('error', 'Pendaftaran gagal: ' . $e->getMessage());

            // Redirect kembali ke halaman register
            return redirect('register');
        } catch (\Exception $e) {
            // Set flash message untuk error lainnya
            Session::flash('error', 'Pendaftaran gagal, silakan coba lagi. Error: ' . $e->getMessage());

            // Redirect kembali ke halaman register
            return redirect('register');
        }
    }
}
