<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class GajiKaryawanController extends Controller
{
    public function GajiKaryawan(){
        $karyawan = Karyawan::all();
        $title= 'Gaji Karyawan';
        return view('admin.laporan', compact('title', 'karyawan'));
    }
}
