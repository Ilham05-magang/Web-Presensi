<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'Home';
        return view('user.home', compact('title', 'user'));
    }

    public function historyLog()
    {
        $user = auth()->user();
        $title = 'History Log';
        return view('user.history-log', compact('title', 'user'));
    }

    public function gantiJam()
    {
        $user = auth()->user();
        $title = 'Data Ganti Jam';
        return view('user.data-ganti-jam', compact('title', 'user'));
    }

    public function presensi(Request $request)
    {
        $user = auth()->user();
        $tanggalHariIni = Carbon::today()->toDateString();

        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();
        dd($absensi);
        
    }
}
