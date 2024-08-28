<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\Users;
use App\Models\Kantor;

class KaryawanController extends Controller
{
    public function KaryawanAdmin()
    {
        $datakaryawan = Karyawan::with('kantor')->get();
        $datadivisi = Divisi::All();
        $datakantor = Kantor::All();
        $datashift = Shift::All();
        $title = 'Karyawan';
        $title2 = 'Data Karyawan';
        return view('admin.karyawan', compact('title','title2','datakaryawan', 'datadivisi', 'datakantor', 'datashift'));
    }
    public function KaryawanDetailAdmin($id)
    {
        // Mengambil data karyawan beserta relasi kantor
        $datakaryawan = Karyawan::with('kantor')->findOrFail($id);

        // Mengambil semua data divisi, kantor, dan shift
        $datadivisi = Divisi::all();
        $datakantor = Kantor::all();
        $datashift = Shift::all();

        // Judul untuk halaman
        $title = 'Karyawan';
        $title2 = 'Data Karyawan';

        // Mengirim data ke view
        return view('admin.show-detail-karyawan', compact('title', 'title2', 'datakaryawan', 'datadivisi', 'datakantor', 'datashift'));
    }


    public function EditKaryawanAdmin(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'divisi_id' => 'sometimes|exists:divisis,id',
            'kantor_id' => 'sometimes|exists:kantors,id',
            'shift_id' => 'sometimes|exists:shifts,id',
            'status_akun' => 'required|in:0,1',
        ],[
            'nama.required' => 'Nama Harus Diisi',
            'nama.string' => 'Nama Harus berupa teks',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 255 Karakter',
            'divisi_id.exists' => 'Divisi ID Tidak Valid',
            'kantor_id.exists' => 'Kantor ID Tidak Valid',
            'shift_id.exists' => 'Shift ID Tidak Valid',
            'status_akun.required' => 'Status Akun Harus Dipilih',
            'status_akun.in' => 'Status Akun Harus berupa 0 atau 1',
        ]);
        // Find the Karyawan and associated Akun records
        $karyawan = Karyawan::find($id);
        $akun = Users::find($karyawan->akun_id);

        // Update Karyawan record
        $karyawan->update([
            'nama' => $request->input('nama'),
            'divisi_id' => $request->input('divisi_id') ?? $karyawan->divisi_id,
            'shift_id' => $request->input('shift_id') ?? $karyawan->shift_id,
            'kantor_id' => $request->input('kantor_id') ?? $karyawan->kantor_id,
        ]);

        // Update Akun record
        $akun->update([
            'status_akun' => $request->input('status_akun'),
        ]);

        return redirect()->back()->with('success', "Data $karyawan->nama Berhasil Di Update ");
    }
    public function DeleteKaryawanAdmin($id){
        $karyawan = Karyawan::find($id);
        $akun = Users::find($karyawan->akun_id);
        $akun->delete();
        return redirect()->back()->with('success', "Data $karyawan->nama Berhasil Di Hapus ");
    }
    public function SearchKaryawanAdmin(Request $request){
        $query = $request->input('query');
        $datakaryawan = Karyawan::where('nama', 'LIKE', '%' . $query . '%')
                ->orWhereHas('divisi', function($q) use ($query) {
                    $q->where('divisi', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('kantor', function($q) use ($query) {
                    $q->where('nama', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('shift', function($q) use ($query) {
                    $q->where('nama', 'LIKE', '%' . $query . '%');
                })
                ->get();
        $datadivisi = Divisi::All();
        $datakantor = Kantor::All();
        $datashift = Shift::All();
        $title = 'Karyawan';
        $title2 = 'Data Karyawan';
        return view('admin.karyawan', compact('title','title2','datakaryawan', 'datadivisi', 'datakantor', 'datashift'));

    }
}
