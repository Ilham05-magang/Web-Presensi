<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Aktivitas;
use App\Models\Quotes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Facades\Agent;

class UserController extends Controller
{
    public function index()
    {
        $izin = false;
        $user = auth()->user();
        $tanggalHariIni = Carbon::today()->toDateString();
        $quotes = Quotes::pluck('quote')->toArray();

        // Mendapatkan absensi hari ini user jika ada
        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();
        // Mengecek apakah user sedang izin atau tidak
        if (!empty($absensi->jam_izin) && empty($absensi->jam_selesai_izin)) {
            $izin = true;
        } else {
            $izin = false;
        }

        $titleButton = $this->determineButtonTitle($absensi);
        if ($titleButton == 'Masuk') {
            $method = 'POST';
            return view('user.home', compact('user', 'absensi', 'titleButton', 'method', 'izin', 'quotes'));
        }
        return view('user.home', compact('user', 'absensi', 'titleButton', 'izin', 'quotes'));
    }

    // Fungsi untuk menentukan nama button presensi
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

    public function presensi()
    {
        $user = auth()->user();
        $tanggalHariIni = Carbon::today()->toDateString();
        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();
        $karyawanId = $user->karyawan->id;
        $shiftId = $user->karyawan->shift_id;

        if ($shiftId != '') {
            // Cek apakah user memiliki sudah presensi hari ini
            if ($absensi == '') {
                Absensi::create([
                    'karyawan_id' => $karyawanId,
                    'shift_id' => $shiftId,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'jam_mulai' => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                    'status_kehadiran' => 'Masuk',
                ]);
                $this->addAktivitas('Masuk');

                return redirect()->back()->with('success', 'Berhasil Presensi Masuk');
            } else if ($absensi->jam_mulai == '') {
                $absensi->update([
                    'jam_mulai' => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                    'status_kehadiran' => 'Masuk',
                ]);
                $this->addAktivitas('Masuk');
            } else {
                $title = $this->determineButtonTitle($absensi);
                $this->updateAbsensiTime($absensi);
                return redirect()->back()->with('success', 'Berhasil Presensi ' . $title);
            }
        } else {
            return redirect()->back()->with('error', 'Shift belum ditentukan, silakan hubungi admin');
        }
    }

    // Update absensi
    private function updateAbsensiTime($absensi)
    {
        $fields = [
            'jam_istirahat',
            'jam_selesai_istirahat',
            'jam_pulang'
        ];

        foreach ($fields as $field) {
            if (empty($absensi->$field)) {
                // Jika jam_pulang kosong maka hitung jam produktif
                if ($field == 'jam_pulang') {
                    $jamProduktif = $this->totalProduktif($absensi);
                    $absensi->update([
                        $field => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                        'jam_total_produktif' => $jamProduktif
                    ]);
                    $this->addAktivitas('Pulang');
                } else {
                    $absensi->update([
                        $field => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                    ]);
                }
                if ($field == 'jam_istirahat') {
                    $this->addAktivitas('Istirahat');
                } else if ($field == 'jam_selesai_istirahat') {
                    $this->addAktivitas('Selesai istirahat');
                }
                break;
            }
        }
    }

    // Update jam izin
    public function izin()
    {
        $fields = [
            'jam_izin',
            'jam_selesai_izin',
        ];
        $user = auth()->user();
        $tanggalHariIni = Carbon::today()->toDateString();
        $absensi = Absensi::where('karyawan_id', $user->karyawan->id)
            ->where('tanggal', $tanggalHariIni)
            ->first();


        if ($user->karyawan->shift_id != '') {
            // Cek apakah user memiliki sudah presensi hari ini
            if ($absensi != '') {
                $message = 'Izin';
                if (empty($absensi->jam_izin) && empty($absensi->jam_selesai_izin)) {
                    $message = 'Izin';
                } else {
                    $message = 'Selesai Izin';
                }
                foreach ($fields as $field) {
                    if (empty($absensi->$field)) {
                        if ($field == 'jam_izin') {
                            $absensi->update([
                                $field => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                            ]);
                            $this->addAktivitas('Izin');
                        } else {
                            $absensi->update([
                                $field => Carbon::now('Asia/Jakarta')->format('H:i:s'),
                            ]);
                            $this->addAktivitas('Selesai izin');
                        }
                        break;
                    }
                }
                return redirect()->back()->with('success', 'Berhasil Presensi ' . $message);
            }
        } else {
            return redirect()->back()->with('error', 'Shift belum ditentukan, silakan hubungi admin');
        }
    }

    // Menghitung jam produktif
    private function totalProduktif($absensi)
    {

        // Konversi string waktu menjadi objek Carbon
        $jamMulai = Carbon::parse($absensi->jam_mulai);
        $jamIstirahat = Carbon::parse($absensi->jam_istirahat);
        $jamSelesaiIstirahat = Carbon::parse($absensi->jam_selesai_istirahat);
        $jamPulang =  Carbon::parse(Carbon::now('Asia/Jakarta')->format('H:i:s'));

        $jamIzin = isset($absensi->jam_izin) ? Carbon::parse($absensi->jam_izin) : null;
        $jamSelesaiIzin = isset($absensi->jam_selesai_izin) ? Carbon::parse($absensi->jam_selesai_izin) : null;

        // Hitung selisih waktu dalam detik
        $jamTotalPagi = $jamMulai->diffInSeconds($jamIstirahat);
        $jamTotalSiang = $jamSelesaiIstirahat->diffInSeconds($jamPulang);

        $jamTotalIzin = 0; // Inisialisasi 0 jika tidak ada izin
        if ($jamIzin && $jamSelesaiIzin) {
            $jamTotalIzin = $jamIzin->diffInSeconds($jamSelesaiIzin);
        }

        // Menghitung total waktu kerja dalam detik
        $totalWaktuKerjaInSeconds = ($jamTotalPagi + $jamTotalSiang) - $jamTotalIzin;
        // Menghitung jam, menit, dan detik secara manual
        $hours = floor($totalWaktuKerjaInSeconds / 3600);
        $minutes = floor(($totalWaktuKerjaInSeconds % 3600) / 60);
        $seconds = $totalWaktuKerjaInSeconds % 60;

        // Memformat ke 00:00:00
        $totalWaktuKerjaFormatted = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return $totalWaktuKerjaFormatted;
    }

    // Fungsi untuk menambahkan setiap aktivitas yang dilakukan user
    private function addAktivitas($deskripsi)
    {
        $user = auth()->user();

        Aktivitas::create([
            'karyawan_id' => $user->karyawan->id,
            'deskripsi' => $deskripsi,
        ]);
    }
}
