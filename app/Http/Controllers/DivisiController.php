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

class DivisiController extends Controller
{
    public function DivisiAdmin()
    {
        $title = 'Divisi';
        $title2= 'Daftar Divisi';
        return view('admin.divisi', compact('title','title2'));
    }
}
