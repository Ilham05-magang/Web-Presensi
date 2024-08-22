<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Admins;
use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        $title = 'Dashboard Karyawan';
        return view('admin.dashboard', compact('title'));
    }
    public function PresensiAdmin()
    {
        $datenow = Carbon::now()->format('d-m-Y');
        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';
        return view('admin.Presensi', compact('title','title2','datenow'));
    }
    public function DivisiAdmin()
    {
        $datenow = Carbon::now()->format('Y-m-d');
        $title = 'Divisi';
        $title2= 'Daftar Divisi';
        return view('admin.divisi', compact('title','title2'));
    }
    public function LaporanAdmin()
    {
        $datenow = Carbon::now()->format('Y-m-d');
        $title = 'Laporan';
        $title2 = 'Data Laporan';
        return view('admin.laporan', compact('title', 'title2'));
    }
    public function KaryawanAdmin()
    {
        $datenow = Carbon::now()->format('Y-m-d');
        $title = 'Karyawan';
        $title2 = 'Data Karyawan';
        return view('admin.karyawan', compact('title','title2'));
    }
    public function PengaturanAdmin()
    {
        $datenow = Carbon::now()->format('Y-m-d');
        $title = 'Pengaturan';
        return view('admin.pengaturan', compact('title'));
    }

    public function absencesbyDay(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        if ($request->date) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
        }
        $absences = DB::select(
            "SELECT 
            k.id AS karyawan_id,
            k.nama,
            a.tanggal,
            a.jam_mulai,
            a.jam_istirahat,
            a.jam_selesai_istirahat,
            a.jam_izin,
            a.jam_selesai_izin,
            a.jam_pulang,
            TIMESTAMPDIFF(MINUTE, COALESCE(a.jam_mulai, a.jam_pulang), COALESCE(a.jam_pulang, a.jam_mulai)) 
                - COALESCE(TIMESTAMPDIFF(MINUTE, a.jam_istirahat, a.jam_selesai_istirahat), 0) 
                - COALESCE(TIMESTAMPDIFF(MINUTE, a.jam_izin, a.jam_selesai_izin), 0) AS total_jam_dalam_menit,
            SEC_TO_TIME(
                TIMESTAMPDIFF(MINUTE, COALESCE(a.jam_mulai, a.jam_pulang), COALESCE(a.jam_pulang, a.jam_mulai)) 
                - COALESCE(TIMESTAMPDIFF(MINUTE, a.jam_istirahat, a.jam_selesai_istirahat), 0) 
                - COALESCE(TIMESTAMPDIFF(MINUTE, a.jam_izin, a.jam_selesai_izin), 0) * 60
            ) AS total_jam_masuk
            FROM 
                karyawans k
            LEFT JOIN 
                absensis a 
            ON k.id = a.karyawan_id AND a.tanggal = ?",[$date]
            );

        return response()->json($absences);
    }
}
