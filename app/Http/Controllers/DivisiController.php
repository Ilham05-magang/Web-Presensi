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
        $dataPerDivisi = Divisi::with('karyawan')->get()->groupBy('divisi_id');
        return view('admin.divisi', compact('title','title2','dataPerDivisi'));
    }

    public function TambahDivisi(Request $request){
        // Validate the request
        $request->validate([
            'divisi' => 'required|string|unique:divisis,divisi',
            'icon' => 'nullable|string'
        ], [
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
            'divisi.required' => 'Nama Divisi Harus Diisi',
            'icon.string' => 'Icon Harus berupa teks',
        ]);

        // Create a new divisi record
        $divisi = Divisi::create([
            'divisi' => $request->input('divisi'),
            'icon' => $request->input('icon')
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', "Data $divisi->divisi Berhasil Ditambah");
    }

    public function EditDivisi(Request $request, $id){
        $request->validate([
            'divisi'=> 'string|unique:divisis,divisi',
            'icon'=> 'nullable|string'
        ],[
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
        ]);

        $divisi = Divisi::findOrFail($id);

        $divisi->update([
            'divisi'=>$request->input('divisi'),
            'icon'=>$request->input('icon')
        ]);
        return redirect()->back()->with('success', "Data $divisi->divisi Berhasil Ditambah");
    }
    public function DeleteDivisi($id){
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();
        return redirect()->back()->with('success', "Data $divisi->divisi Berhasil Ditambah");
    }
    public function SearchDivisi(Request $request){
        $search = $request->input('query');
        $title = 'Divisi';
        $title2= 'Daftar Divisi';
        $dataPerDivisi = Divisi::with('karyawan')
        ->where('divisi','LIKE', '%'. $search. '%')
        ->get()->groupBy('divisi_id');

        return view('admin.divisi', compact('title','title2','dataPerDivisi'));
    }
    public function DetailDivisiAdmin($id)
    {
        $title = 'Divisi';
        $dataPerDivisi = Divisi::where('id', $id)
            ->with('karyawan')
            ->first();
        if (!$dataPerDivisi) {
            return redirect()->back()->with('error', 'Divisi tidak ditemukan.');
        }
        return view('admin.show-detail-divisi', compact('title', 'dataPerDivisi'));
    }



}
