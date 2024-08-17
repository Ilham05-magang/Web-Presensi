<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Interns;
use App\Models\Akuns;
use App\Models\Instansi;

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

    private function validateInternData($request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:akuns',
            'email' => 'required|string|email|max:255|unique:akuns',
            'telepon' => 'required|string|max:16',
            'ttl' => 'required|string',
            'instansi' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
        ]);
    }

    public function registerintern(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateInternData($request);

        // Create Akun first and get its ID
        $akun = Akuns::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'status_akun' => false,
            'role_id' => 1
        ]);

        // Create the Interns record using the newly created Akun ID
        Interns::create([
            'akun_id' => $akun->id,  // Corrected field name
            'nama' => $validatedData['nama'],
            'telepon' => $validatedData['telepon'],
            'ttl' => $validatedData['ttl'],
        ]);

        // Create the Instansi record
        Instansi::create([
            'nama' => $validatedData['instansi'],
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }



    public function registeradmin(Request $request)
    {
        $validatedData = $this->validateInternData($request);

    }
    public function registercontributor(Request $request)
    {
        $validatedData = $this->validateInternData($request);
    }


}
