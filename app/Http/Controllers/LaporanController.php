<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Admins;
use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\Users;
use App\Models\Kantor;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function LaporanAdmin()
    {
        $title = 'Laporan';
        $title2 = 'Data Laporan';
        return view('admin.laporan', compact('title', 'title2'));
    }
}
