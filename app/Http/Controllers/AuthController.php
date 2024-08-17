<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Models\DInterns;

class AuthController extends Controller
{
    public function loginindex()
    {
        $title = 'Masuk Akun';
        return view('auth.login', compact('title'));
    }

    public function registerindex()
    {
        $title = 'Daftar Akun';
        return view('auth.register', compact('title'));
    }

    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:d_interns',
            'email' => 'required|string|email|max:255|unique:d_interns',
            'telepon' => 'required|string|max:16',
            'ttl' => 'required|string',
            'instansi' => 'required|string|max:255',
            'password' => 'required|string|confirmed', // `confirmed` akan memeriksa jika password dan password_confirmation cocok
        ]);

        // Buat pengguna baru jika validasi berhasil
        DInterns::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'telepon' => $request->telepon,
            'ttl' => $request->ttl,
            'instansi' => $request->instansi,
            'password' => Hash::make($request->password),
            'status_akun' => false,
            'role_id' => 1
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
