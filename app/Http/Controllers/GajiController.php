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

class GajiController extends Controller
{
    public function gajiAdmin()
    {
        $title = 'Gaji';
        $title2 = 'Data Gaji';
        return view('admin.gaji.gaji', compact('title', 'title2'));
    }
    public function defaultGaji()
    {
        $title = 'Default Gaji';
        $title2 = 'Default Gaji';
        return view('admin.gaji.default-gaji', compact('title', 'title2'));
    }
    public function inputGaji()
    {
        $title = 'Gaji Karyawan';
        $title2 = 'Input Gaji';
        return view('admin.gaji.input-gaji', compact('title', 'title2'));
    }
    public function riwayatGaji()
    {
        $title = 'Riwayat Gaji';
        $title2 = 'Riwayat Gaji';
        return view('admin.gaji.riwayat-gaji', compact('title', 'title2'));
    }
    public function showDetailGaji()
    {
        $title = 'Detail Gaji';
        $title2 = 'Detail Gaji';
        return view('admin.gaji.show-detail-gaji', compact('title', 'title2'));
    }

    public function testingCustom(Request $request) {

        $customName = [];
        $customValue = [];

        // Loop through the request data to find custom_x and customValue_x pairs
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'custom_')) {
                // Append the value to the $customNames array
                $customName[] = $value;
            }
        
            if (str_starts_with($key, 'customValue_')) {
                // Append the value to the $customValues array
                $customValue[] = $value;
            }
        }
    
        // Convert the custom data array to JSON
        $jsonCustomName = json_encode($customName);
        $jsonCustomValue = json_encode($customValue);
    
    }
}
