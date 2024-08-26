<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Users;
use App\Models\Karyawan;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function loginindex()
    {
        $title = 'Masuk Akun';
        return view('auth.login', compact('title'))->with('error','ini errorlah');
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



    public function adminindex()
    {
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

    public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    // Menentukan input email atau username
    $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    // Mengecek apakah tedapat email atau username yang sama di tabel user
    $user = Users::where($loginType, $request->email)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Username/email tidak ditemukan')->withInput();
    }

    // Mengecek apakah password 
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->route('login')->with('error', 'Password yang dimasukkan salah')->withInput();
    }

    $infologin = [
        $loginType => $request->email,
        'password' => $request->password,
    ];
    $remember = $request->input('remember_me');

    if (Auth::attempt($infologin, $remember)) {
        Cookie::queue('email', $request->email, 60 * 24 * 30); // Store for 30 days
        
        if (Auth::user()->role->role == 'admin' && Auth::user()->status_akun == 1) {
            return redirect()->route('dashboard');
        } else if (Auth::user()->role->role == 'karyawan' && Auth::user()->status_akun == 1) {
            Aktivitas::create([
                'karyawan_id'=> auth()->user()->karyawan->id,
                'deskripsi'=> 'Login',
            ]);
            return redirect()->route('home');
        } else {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Status akun anda belum aktif! Silakan hubungi Admin');
        }
    } else {
        return redirect()->route('login')->with('error', 'Username/email dan password tidak sesuai')->withInput();
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
