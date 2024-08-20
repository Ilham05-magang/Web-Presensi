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
        $tanggalHariIni = Carbon::today()->toDateString();

        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        $titleButton = $this->determineButtonTitle($absensi);

        return view('user.home', compact('user', 'absensi', 'titleButton'));
    }

    private function determineButtonTitle($absensi)
    {
        if ($absensi == null) {
            return "Masuk";
        }

        $titles = [
            'jam_mulai' => "Masuk",
            'jam_istirahat' => "Istirahat",
            'jam_selesai_istirahat' => "Kembali",
            'jam_pulang' => "Pulang"
        ];

        foreach ($titles as $field => $title) {
            if (empty($absensi->$field)) {
                return $title;
            }
        }

        return "Telah Pulang";
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

    public function presensi()
    {
        $user = auth()->user();
        $tanggalHariIni = Carbon::today()->toDateString();
        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        if ($absensi != null) {
            $this->updateAbsensiTime($absensi);
        }

        return redirect()->route('home');
    }

    private function updateAbsensiTime($absensi)
    {
        $fields = [
            'jam_mulai',
            'jam_istirahat',
            'jam_selesai_istirahat',
            'jam_pulang'
        ];

        foreach ($fields as $field) {
            if (empty($absensi->$field)) {
                $absensi->update([
                    $field => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                ]);
                break;
            }
        }
    }
}
