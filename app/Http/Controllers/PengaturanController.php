<?php

namespace App\Http\Controllers;
use App\Models\Admins;
use App\Models\Shift;
use App\Models\Users;
use App\Models\Kantor;
use App\Models\Quotes;
use App\Models\TanggalLibur;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
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

        $request->validate([
            'nama' => 'string|nullable',
            'username' => [
                'string',
                'max:255',
                'nullable',
                Rule::unique('users', 'username')->ignore($akun->id),
            ],
            'email' => [
                'string',
                'email',
                'max:255',
                'nullable',
                Rule::unique('users', 'email')->ignore($akun->id),
            ],
            'telepon' => 'string|max:16|nullable',
            'password' => 'nullable|string|confirmed',
        ], [
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'telepon.string' => 'Telepon harus berupa teks.',
            'telepon.max' => 'Telepon tidak boleh lebih dari 16 karakter.',
            'password.confirmed' => 'Password baru dan konfirmasi password tidak sama.'
        ]);

        $Admin->update([
            'nama' => $request->input('nama') ,
            'telepon' => $request->input('telepon') ,
        ]);
        if ($request->filled('password')){
            $akun->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            $message = 'Data Profile dan Password berhasil di Perbaharui';
        } else {
            $akun->update([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
            ]);
            $message = 'Data Profile berhasil di Perbaharui';
        }
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
            'nama' => 'required|unique:kantors,nama',
            'link_gmaps' => 'nullable|String'
        ],[
            'nama.unique' => 'Nama Kantor Sudah Tersedia',
            'nama.string' => 'Nama Kantor Harus berupa teks',
            'nama.required' => 'Nama Kantor Harus Diisi',
            'link_gmaps.string' => 'Nama link Gmaps Harus berupa teks',
        ]);
        $kantor = Kantor::create([
            'nama' => $request->input('nama'),
            'link_gmaps' => $request->input('link_gmaps'),
        ]);
        return redirect()->back()->with('success', "Data $kantor->nama berhasil di Tambah");
    }

    public function PengaturanEditKantor(Request $request, $id)
    {
        $request->validate([
            'nama' => 'nullable|string|unique:kantors,nama',
            'link_gmaps' => 'nullable|string'
        ],[
            'nama.unique' => 'Nama Kantor Sudah Tersedia',
            'nama.string' => 'Nama Kantor Harus berupa teks',
            'link_gmaps.string' => 'Nama link Gmaps Harus berupa teks',
        ]);

        $kantor = Kantor::findOrFail($id);
        $kantor->update([
            'nama' => $request->input('nama') ?? $kantor->nama,
            'link_gmaps' => $request->input('link_gmaps') ?? $kantor->link_gmaps,
        ]);

        return redirect()->back()->with('success', "Data $kantor->nama berhasil di Update");
    }


    public function PengaturanDeleteKantor($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->delete();
        return redirect()->back()->with('success', "Data $kantor->nama Berhasil Dihapus");
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
            'nama' => 'required|string|unique:shifts,nama',
            'jam_mulai' => 'required|string',
            'jam_istirahat' => 'required|string',
            'jam_selesai_istirahat' => 'required|string',
            'jam_pulang' => 'required|string',
        ], [
            'nama.required' => 'Nama Shift Harus Diisi',
            'nama.string' => 'Nama Shift Harus berupa teks',
            'nama.unique' => 'Nama Shift Sudah Tersedia',
            'jam_mulai.required' => 'Jam Mulai Harus Diisi',
            'jam_mulai.string' => 'Jam Mulai Harus berupa teks',
            'jam_istirahat.required' => 'Jam Istirahat Harus Diisi',
            'jam_istirahat.string' => 'Jam Istirahat Harus berupa teks',
            'jam_selesai_istirahat.required' => 'Jam Selesai Istirahat Harus Diisi',
            'jam_selesai_istirahat.string' => 'Jam Selesai Istirahat Harus berupa teks',
            'jam_pulang.required' => 'Jam Pulang Harus Diisi',
            'jam_pulang.string' => 'Jam Pulang Harus berupa teks',
        ]);

        $jamMulai = $request->input('jam_mulai');
        $jamPulang = $request->input('jam_pulang');
        $jamIstirahat = $request->input('jam_istirahat');
        $jamSelesaiIstirahat = $request->input('jam_selesai_istirahat');

        $waktuProduktif = $this->kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat);
        // Create a new Shift record
        $shift = Shift::create([
            'nama' => $request->input('nama'),
            'jam_mulai' => $jamMulai,
            'jam_istirahat' => $jamIstirahat,
            'jam_selesai_istirahat' => $jamSelesaiIstirahat,
            'jam_pulang' => $jamPulang,
            'jam_total_produktif' => $waktuProduktif,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', "Data $shift->nama berhasil ditambahkan");
    }
    public function PengaturanEditShift(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'nullable|string|unique:shifts,nama',
            'jam_mulai' => 'nullable|string',
            'jam_istirahat' => 'nullable|string',
            'jam_selesai_istirahat' => 'nullable|string',
            'jam_pulang' => 'nullable|string',
        ],[
            'nama.string' => 'Nama Shift Harus berupa teks',
            'nama.unique' => 'Nama Shift Sudah Tersedia',
            'jam_mulai.string' => 'Jam Mulai Harus berupa teks',
            'jam_istirahat.string' => 'Jam Istirahat Harus berupa teks',
            'jam_selesai_istirahat.required' => 'Jam Selesai Istirahat Harus Diisi',
            'jam_selesai_istirahat.string' => 'Jam Selesai Istirahat Harus berupa teks',
            'jam_pulang.string' => 'Jam Pulang Harus berupa teks',
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
        return redirect()->back()->with('success', "Data $shift->nama berhasil diubah");
    }
    public function PengaturanDeleteShift($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();
        return redirect()->back()->with('success', "Data $shift->nama berhasil dihapus");
    }

    public function PengaturanTanggal() {
        $title = 'Pengaturan Tanggal Libur';
        $data = TanggalLibur::All();
        return view('admin.pengaturan.tanggal', compact('title', 'data'));
    }

    public function PengaturanTambahTanggal(Request $request)
    {
        // Validate the request data
        $request->validate([
            'tanggal_libur' => 'required|date',
        ]);

        $tanggal = $request->input('tanggal_libur');

        // Create a new Shift record
        TanggalLibur::create([
            'tanggal_libur'=> $tanggal,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Tanggal libur berhasil ditambahkan');
    }

    public function PengaturanDeleteTanggal($id)
    {
        $tanggalLibur = TanggalLibur::findOrFail($id);
        $tanggalLibur->delete();
        return redirect()->back()->with('success', 'Data Tanggal libur berhasil dihapus');
    }

    public function PengaturanEditTanggal(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'tanggal_libur' => 'date',
        ]);

        $data = TanggalLibur::findOrFail($id);
        $tanggal_libur = $request->input('tanggal_libur');

        // Create a new Shift record
        $data->update([
            'tanggal_libur' => $tanggal_libur,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Tanggal libur berhasil diubah');
    }

    public function PengaturanQuotes() {
        $title = 'Pengaturan Quotes';
        $data = Quotes::All();
        return view('admin.pengaturan.quotes', compact('title', 'data'));
    }

    public function PengaturanTambahQuote(Request $request)
    {
        // Validate the request data
        $request->validate([
            'quote' => 'required',
        ]);

        $quote = $request->input('quote');

        // Create a new Shift record
        Quotes::create([
            'quote'=> $quote,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Quotes berhasil ditambahkan');
    }

    public function PengaturanDeleteQuote($id)
    {
        $quote = Quotes::findOrFail($id);
        $quote->delete();
        return redirect()->back()->with('success', 'Data Quotes berhasil dihapus');
    }

    public function PengaturanEditQuote(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'quote' => 'string',
        ]);

        $data = Quotes::findOrFail($id);
        $quote = $request->input('quote');

        // Create a new Shift record
        $data->update([
            'quote' => $quote,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data Quotes berhasil diubah');
    }


}
