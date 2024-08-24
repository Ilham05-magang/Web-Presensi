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
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class PengaturanController extends Controller
{
    #Controller Profile
    public function PengaturanProfile()
    {
        $data = auth()->user();
        $title = 'Pengaturan Profile';
        return view('admin.pengaturan.profile', compact('title', 'data'));
    }
    public function PengaturanEditProfile(Request $request, $id)
    {
        $Admin = Admins::findOrFail($id);
        $akun = Users::findOrFail($Admin->akun_id);

        // Validation rules
        $request->validate([
            'nama' => 'string|nullable',
            'username' => [
                'string',
                'max:255',
                'nullable',
                'unique:users'
            ],
            'email' => [
                'string',
                'email',
                'max:255',
                'nullable',
                'unique:users'
            ],
            'telepon' => 'string|max:16|nullable',
            'passwordLama' => 'required_with:password,password_confirmation',
            'password' => 'required_with:passwordLama|confirmed',
        ], [
            'password.required_with' => 'Password baru wajib diisi jika Password lama terisi.',
            'password_confirmation.required_with' => 'Konfirmasi password baru wajib diisi jika Password lama terisi.',
            'password.confirmed' => 'Password baru dan konfirmasi password tidak sama.',
            'password.min' => 'Password baru harus memiliki minimal 8 karakter.',
        ]);

        // Track if password was updated
        $passwordUpdated = false;

        // Check if the old password is provided and matches the current password
        if ($request->filled('passwordLama') && Hash::check($request->input('passwordLama'), $akun->password)) {
            $akun->update([
                'username' => $request->input('username') ?? $akun->username,
                'email' => $request->input('email') ?? $akun->email,
                'password' => Hash::make($request->input('password'))
            ]);
            $passwordUpdated = true;
            $message = 'Data profile dan password berhasil diupdate';
        } else {
            // If the old password is incorrect, set the message and update only other fields
            $message = 'Inputan password lama salah';
            if ($request->input('username') || $request->input('email')) {
                $akun->update([
                    'username' => $request->input('username') ?? $akun->username,
                    'email' => $request->input('email') ?? $akun->email,
                ]);
                $message = 'Data Profile berhasil di update';
            }
        }

        // Update Admin data
        if ($request->input('nama') || $request->input('telepon')) {
            $Admin->update([
                'nama' => $request->input('nama') ?? $Admin->nama,
                'telepon' => $request->input('telepon') ?? $Admin->telepon,
            ]);
            $message = 'Data Profile berhasil di update';
        }
        // Redirect back with the appropriate message
        return redirect()->back()->with('success', $message);
    }











    #Controller Kantor
    public function PengaturanKantor()
    {
        $data = Kantor::all();
        $title = 'Pengaturan Kantor';
        return view('admin.pengaturan.kantor', compact('title', 'data'));
    }

    public function PengaturanTambahKantor(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'link_gmaps' => 'nullable|String'
        ]);
        Kantor::create([
            'nama' => $request->input('nama'),
            'link_gmaps' => $request->input('link_gmaps'),
        ]);
        return redirect()->back()->with('success', "Data Kantor berhasil diperbarui");
    }

    public function PengaturanEditKantor(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'link_gmaps' => 'nullable|string'
        ]);
        $kantor = Kantor::findOrFail($id);
        $kantor->update([
            'nama' => $request->input('nama'),
            'link_gmaps' => $request->input('link_gmaps'),
        ]);

        return redirect()->back()->with('success', "Data Kantor '{$kantor->nama}' berhasil diperbarui");
    }
    public function PengaturanDeleteKantor($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->delete();
        return redirect()->back()->with('success', "Kantor berhasil diperbarui");
    }


    #Controller Shift
    private function kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat)
    {
        $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulai);
        $jamPulang = Carbon::createFromFormat('H:i:s', $jamPulang);
        $jamIstirahat = Carbon::createFromFormat('H:i:s', $jamIstirahat);
        $jamSelesaiIstirahat = Carbon::createFromFormat('H:i:s', $jamSelesaiIstirahat);

        // Hitung durasi kerja dan istirahat dalam detik
        $durasiKerja = $jamPulang->diffInSeconds($jamMulai);
        $durasiIstirahat = $jamSelesaiIstirahat->diffInSeconds($jamIstirahat);

        $totalProduktif = $durasiKerja - $durasiIstirahat;

        // Konversi detik ke format H:i:s
        $jam = floor($totalProduktif / 3600);
        $menit = floor(($totalProduktif % 3600) / 60);
        $detik = $totalProduktif % 60;

        return sprintf('%02d:%02d:%02d', $jam, $menit, $detik);
    }
    public function PengaturanShift()
    {
        $data = Shift::All();
        $title = 'Pengaturan Shift';
        return view('admin.pengaturan.shift', compact('title', 'data'));
    }
    public function PengaturanTambahShift(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_istirahat' => 'required|string',
            'jam_selesai_istirahat' => 'required|string',
            'jam_pulang' => 'required|string',
        ]);

        $jamMulai = $request->input('jam_mulai');
        $jamPulang = $request->input('jam_pulang');
        $jamIstirahat = $request->input('jam_istirahat');
        $jamSelesaiIstirahat = $request->input('jam_selesai_istirahat');

        $waktuProduktif = $this->kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat);
        // Create a new Shift record
        Shift::create([
            'nama' => $request->input('nama'),
            'jam_mulai' => $jamMulai,
            'jam_istirahat' => $jamIstirahat,
            'jam_selesai_istirahat' => $jamSelesaiIstirahat,
            'jam_pulang' => $jamPulang,
            'jam_total_produktif' => $waktuProduktif,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Shift berhasil ditambahkan');
    }
    public function PengaturanEditShift(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'nullable|string',
            'jam_mulai' => 'nullable|string',
            'jam_istirahat' => 'nullable|string',
            'jam_selesai_istirahat' => 'nullable|string',
            'jam_pulang' => 'nullable|string',
        ]);

        $shift = Shift::findOrFail($id);
        $jamMulai = $request->input('jam_mulai') ?? $shift->jam_mulai;
        $jamPulang = $request->input('jam_pulang') ?? $shift->jam_pulang;
        $jamIstirahat = $request->input('jam_istirahat') ?? $shift->jam_istirahat;
        $jamSelesaiIstirahat = $request->input('jam_selesai_istirahat') ?? $shift->jam_selesai_istirahat;

        $waktuProduktif = $this->kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat);

        // Create a new Shift record
        $shift->update([
            'nama' => $request->input('nama') ?? $shift->nama,
            'jam_mulai' => $jamMulai,
            'jam_istirahat' => $jamIstirahat,
            'jam_selesai_istirahat' => $jamSelesaiIstirahat,
            'jam_pulang' => $jamPulang,
            'jam_total_produktif' => $waktuProduktif,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Shift berhasil diubah');
    }
    public function PengaturanDeleteShift($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();
        return redirect()->back()->with('success', 'Data Shift berhasil dihapus');
    }

}
