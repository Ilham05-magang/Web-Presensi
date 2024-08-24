<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Admins;
use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\Users;
use App\Models\Kantor;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        $dateQuery = Carbon::now()->format('Y-m-d');
        $totalkaryawan = Karyawan::All()->count();

        $dataAbsensi = Karyawan::with(['absensi' => function($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])->get();
        $statusMasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();

        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totalmasuk = $statusMasuk;
        $totaltidakmasuk = $totalkaryawan - $statusMasuk - $totalIzin;
        $title = 'Dashboard Karyawan';
        return view('admin.dashboard', compact('title','totalkaryawan','totalmasuk','totaltidakmasuk','totalIzin'));
    }
}
