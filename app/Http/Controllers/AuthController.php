<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Users;
use App\Models\Karyawan;
use App\Models\Admins;

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

    private function validateData($request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|string|max:16',
            'nip' => 'string|max:20',
            'ttl' => 'string',
            'password' => 'required|string|confirmed',
        ]);
    }

    public function registerkaryawan(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateData($request);

        $akun = Users::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status_akun' => false,
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(20),
        ]);

        Karyawan::create([
            'akun_id' => $akun->id,
            'nama' => $validatedData['nama'],
            'telepon' => '+62' . $validatedData['telepon'],
            'nip' => $validatedData['nip'],
            'ttl' => $validatedData['ttl'],

        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }



    public function adminindex(){
        $title = 'Admin';
        return view('auth.admin-register', compact('title'));
    }

    public function registeradmin(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateData($request);

        $akun = Users::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status_akun' => true,
            'role_id' => 2,
            'email_verified_at' => now(),
            'remember_token' => Str::random(20),
        ]);

        Admins::create([
            'akun_id' => $akun->id,
            'nama' => $validatedData['nama'],
            'telepon' => '+62' . $validatedData['telepon'],
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }


}
