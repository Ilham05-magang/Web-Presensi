<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DivisiController extends Controller
{
    public function DivisiAdmin()
    {
        $title = 'Divisi';
        $title2 = 'Daftar Divisi';
        $dataPerDivisi = Divisi::with('karyawan')->get()->groupBy('divisi_id');
        return view('admin.divisi', compact('title', 'title2', 'dataPerDivisi'));
    }

    public function TambahDivisi(Request $request)
    {
        // Validate the request
        $request->validate([
            'divisi' => 'required|string|unique:divisis,divisi',
        ], [
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
            'divisi.required' => 'Nama Divisi Harus Diisi',
        ]);

        $divisi = Divisi::create([
            'divisi' => $request->input('divisi'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', "Data $divisi->divisi Berhasil Ditambah");
    }

    public function EditDivisi(Request $request, $id)
    {
        $request->validate([
            'divisi' => [
                'required',
                'string',
                Rule::unique('divisis', 'divisi')->ignore($id), // Mengabaikan record dengan ID saat ini
            ],
        ], [
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
        ]);

        $divisi = Divisi::findOrFail($id);

        $divisi->update([
            'divisi' => $request->input('divisi'),
        ]);
        return redirect()->back()->with('success', "Data $divisi->divisi Berhasil Ditambah");
    }
    public function DeleteDivisi($id)
    {
        $title = 'Divisi';
        $title2 = 'Daftar Divisi';
        $divisi = Divisi::findOrFail($id);

        $divisiName = $divisi->divisi;
        $divisi->delete();

        $dataPerDivisi = Divisi::with('karyawan')->get()->groupBy('divisi_id');

        return redirect()->route('dashboard.divisi', compact('title', 'title2', 'dataPerDivisi'))
            ->with('success', "Divisi $divisiName Berhasil Dihapus");
    }
    public function SearchDivisi(Request $request)
    {
        $search = $request->input('query');
        $title = 'Divisi';
        $title2 = 'Daftar Divisi';
        $dataPerDivisi = Divisi::with('karyawan')
            ->where('divisi', 'LIKE', '%' . $search . '%')
            ->get()->groupBy('divisi_id');

        return view('admin.divisi', compact('title', 'title2', 'dataPerDivisi'));
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
