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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
            'icon' => 'nullable|mimes:jpg,jpeg,png|max:1024|dimensions:ratio=1/1'
        ], [
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
            'divisi.required' => 'Nama Divisi Harus Diisi',
            'icon.mimes' => 'File harus berupa format jpg, png.',
            'icon.max' => 'Ukuran file maksimal adalah 1MB.',
            'icon.dimensions' => 'Ukuran rasio gambar harus 1:1.',
        ]);
        $filePath = $request->hasFile('icon') ? $request->file('icon')->store('public/divisi') : null;

        $divisi = Divisi::create([
            'divisi' => $request->input('divisi'),
            'icon' => $filePath
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
            'icon' => 'nullable|file|mimes:jpg,jpeg,png|max:1024|dimensions:ratio=1/1'
        ], [
            'divisi.unique' => 'Nama Divisi Sudah Tersedia',
            'divisi.string' => 'Nama Divisi Harus berupa teks',
            'icon.mimes' => 'File harus berupa format jpg, png.',
            'icon.max' => 'Ukuran file maksimal adalah 1MB.',
            'icon.dimensions' => 'Ukuran rasio gambar harus 1:1.',
        ]);

        $divisi = Divisi::findOrFail($id);

        $oldFile = $divisi->icon;

        if ($request->hasFile('icon')) {
            // Hapus file lama jika ada
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                if (Storage::disk('public')->delete($oldFile)) {
                    Log::info("File $oldFile berhasil dihapus.");
                } else {
                    Log::error("Gagal menghapus file $oldFile.");
                }
            } else {
                Log::info("File $oldFile tidak ditemukan atau tidak ada.");
            }
            // Upload file baru
            $file = $request->file('icon') ?? null;
            $filePath = $file->store('divisi', 'public') ?? null;
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $filePath = $oldFile ?? null;
        }

        $divisi->update([
            'divisi' => $request->input('divisi'),
            'icon' => $filePath
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
