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
}
