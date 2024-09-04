<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\TanggalLibur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PresensiController extends Controller
{
    public function PresensiAdmin()
    {
        $dateQuery = Carbon::now()->format('Y-m-d');

        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])
        ->whereHas('akun', function ($query) {
            $query->where('status_akun', 1);
        })->get();

        $dataTanggalLibur = TanggalLibur::All();

        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = Absensi::where('status_kehadiran', 'Tidak Masuk')->whereDate('tanggal', $dateQuery)->count();

        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';
        return view('admin.Presensi', compact('title', 'title2', 'dataAbsensi', 'totalmasuk', 'totaltidakmasuk', 'totalIzin', 'dataTanggalLibur','dateQuery'));
    }

    public function SearchPresensiAdmin(Request $request, $tanggal){
        $tanggalparse = $tanggal ?? Carbon::now()->format('Y-m-d');
        $dateQuery = Carbon::create($tanggalparse)->format('Y-m-d');
        $searchQuery= $request->input('query');


        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])
            ->where('nama', 'LIKE', '%' . $searchQuery . '%') // Filter by employee name
            ->get();
        $dataTanggalLibur = TanggalLibur::All();
        $totalkaryawan = Karyawan::All()->count();
        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = Absensi::where('status_kehadiran', 'Tidak Masuk')->whereDate('tanggal', $dateQuery)->count();


        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';
        return view('admin.Presensi', compact('title','title2','totalIzin','dateQuery','dataAbsensi','totalmasuk','totaltidakmasuk','dataTanggalLibur'));
    }
    public function SearchPresensibyDateAdmin(Request $request)
    {
        // Use Carbon to get the current date in the correct format for comparison
        $dateQuery = $request->input('date', Carbon::now()->format('Y-m-d'));
        // Fetch karyawan with absensi for the specified date
        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])->get();
        $dataTanggalLibur = TanggalLibur::All();

        // Calculate totals
        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = Absensi::where('status_kehadiran', 'Tidak Masuk')->whereDate('tanggal', $dateQuery)->count();

        // Set title variables
        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';

        // Return the view with compacted variables
        return view('admin.Presensi', compact('title','title2','totalIzin','dataAbsensi','totalmasuk','totaltidakmasuk','dateQuery','dataTanggalLibur'));
    }

    private function kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat, $jamIzin, $jamSelesaiIzin)
    {
        if($jamIstirahat){
            $jamIstirahat = Carbon::createFromFormat('H:i:s', $jamIstirahat);
            $jamSelesaiIstirahat = Carbon::createFromFormat('H:i:s', $jamSelesaiIstirahat);
            $durasiIstirahat = $jamSelesaiIstirahat->diffInSeconds($jamIstirahat);
        }
        if($jamIzin){
            $jamIzin = Carbon::createFromFormat('H:i:s', $jamIzin);
            $jamSelesaiIzin = Carbon::createFromFormat('H:i:s', $jamSelesaiIzin);
            $durasiIzin = $jamSelesaiIzin->diffInSeconds($jamIzin);
        }
        if($jamMulai && $jamPulang){
            $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulai);
            $jamPulang = Carbon::createFromFormat('H:i:s', $jamPulang);
            $durasiKerja = $jamPulang->diffInSeconds($jamMulai);
        }

        // Hitung durasi kerja dan istirahat dalam detik
        $totalProduktif = ($durasiKerja ?? null) - ($durasiIstirahat ?? null) - ($durasiIzin ?? null) ;

        if($totalProduktif){
            // Konversi detik ke format H:i:s
            $jam = floor($totalProduktif / 3600);
            $menit = floor(($totalProduktif % 3600) / 60);
            $detik = $totalProduktif % 60;

            return sprintf('%02d:%02d:%02d', $jam, $menit, $detik);
        } else{
            return null;
        }

    }
    public function EditPresensi(Request $request, $id){
        $request->validate([
            'jam_mulai' => 'nullable|string',
            'jam_istirahat' => 'nullable|string',
            'jam_izin' => 'nullable|string',
            'jam_selesai_izin' => 'nullable|string',
            'jam_selesai_istirahat' => 'nullable|string',
            'jam_pulang' => 'nullable|string',
            'status_kehadiran' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_input' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:1024',
        ],[
            'jam_mulai.string' => 'Jam Mulai Harus berupa teks',
            'jam_istirahat.string' => 'Jam Istirahat Harus berupa teks',
            'jam_izin.string' => 'Jam Izin Harus berupa teks',
            'jam_selesai_izin.string' => 'Jam Selesai Izin Harus berupa teks',
            'jam_selesai_istirahat.string' => 'Jam Selesai Istirahat Harus berupa teks',
            'jam_pulang.string' => 'Jam Pulang Harus berupa teks',
            'status_kehadiran.string' => 'Status Kehadiran Harus berupa teks',
            'file_input.mimes' => 'File harus berupa format jpg, png, atau pdf.',
            'file_input.max' => 'Ukuran file maksimal adalah 1MB.',
        ]);

        $absensi = Absensi::findOrFail($id);
        $karyawan = Karyawan::findOrFail($absensi->karyawan_id);
        $tanggal = Carbon::parse($absensi->tanggal)->locale('id')->translatedFormat('d - F - Y');

        $jamMulai = $request->input('jam_mulai') ?? $absensi->jam_mulai ?? null;
        $jamPulang = $request->input('jam_pulang')?? $absensi->jam_pulang ?? null;
        $jamIstirahat = $request->input('jam_istirahat')?? $absensi->jam_istirahat ?? null;
        $jamSelesaiIstirahat = $request->input('jam_selesai_istirahat')?? $absensi->jam_selesai_istirahat ?? null;
        $jamIzin = $request->input('jam_izin')?? $absensi->jam_izin ?? null;
        $jamSelesaiIzin = $request->input('jam_selesai_izin')?? $absensi->jam_selesai_izin ?? null;
        $waktuProduktif = $this->kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat, $jamIzin, $jamSelesaiIzin);
        $oldFile = $absensi->file_input;

        if ($request->hasFile('file_input')) {
            // Hapus file lama jika ada
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                if (Storage::disk('public')->delete($oldFile)) {
                    Log::info("File $oldFile berhasil dihapus.");
                } else {
                    Log::error("Gagal menghapus file $oldFile.");
                }
            }else {
                Log::info("File $oldFile tidak ditemukan atau tidak ada.");
            }
            // Upload file baru
            $file = $request->file('file_input') ?? null;
            $filePath = $file->store('absensi_files', 'public') ?? null;
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $filePath = $oldFile ?? null;
        }

        if ($request->hasFile('file_input')) {
            $absensi->update([
                'jam_mulai' => $jamMulai,
                'jam_istirahat' => $jamIstirahat,
                'jam_izin' => $jamIzin,
                'jam_selesai_izin' => $jamSelesaiIzin,
                'jam_selesai_istirahat' => $jamSelesaiIstirahat,
                'jam_pulang' => $jamPulang,
                'jam_total_produktif' => $waktuProduktif,
                'status_kehadiran'=>$request->input('status_kehadiran') ?? $absensi->status_kehadiran ?? null,
                'keterangan' => $request->input('keterangan') ?? $absensi->keterangan  ?? null,
                'file_input' => $filePath
            ]);
        }else{
            $absensi->update([
                'jam_mulai' => $jamMulai,
                'jam_istirahat' => $jamIstirahat,
                'jam_izin' => $jamIzin,
                'jam_selesai_izin' => $jamSelesaiIzin,
                'jam_selesai_istirahat' => $jamSelesaiIstirahat,
                'jam_pulang' => $jamPulang,
                'jam_total_produktif' => $waktuProduktif,
                'status_kehadiran'=>$request->input('status_kehadiran') ?? $absensi->status_kehadiran ?? null,
            ]);
        }
        // Update data

        return redirect()->back()->with('success', "Data Absensi Tanggal $tanggal  pada Karyawan $karyawan->nama berhasil di Update");
    }
    public function DeleteAbsensi($id){
        $karyawan = Karyawan::findOrFail($id);
        $absensi = Absensi::findOrFail($id);
        $tanggal = Carbon::parse($absensi->tanggal)->locale('id')->translatedFormat('d-F-Y');
        $absensi->delete();
        return redirect()->back()->with('success', "Data Absensi Tanggal $tanggal pada Karyawan $karyawan->nama berhasil di Hapus");
    }



    public function ShowDetailAbsensi($id)
    {
        $selectedMonth = Carbon::now()->format('m');
        $datenow = Carbon::now();
        $dateQuery = $datenow->format('m-Y');
        $tanggalPerPeriode = null;
        $tanggalMulai = null;
        $totalmasuk = 0;
        $totalIzin = 0;
        $totaltidakmasuk = 0;

        $dataTanggalLibur = TanggalLibur::All();

        // Fetch karyawan details
        $karyawan = Karyawan::find($id);

        $title = "Data Absensi Karyawan";

        return view('admin.show-detail-presensi', compact('title', 'karyawan', 'totalmasuk', 'totalIzin', 'totaltidakmasuk', 'selectedMonth', 'dataTanggalLibur','dateQuery','datenow','tanggalPerPeriode','tanggalMulai'));
    }

    public function SearchAbsensiByPeriode(Request $request, $id)
    {
        $absensi = new Absensi();
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $datenow = Carbon::now();
        $selectedMonth = $request->input('month');
        $month = $request->input('month');
        $year = Carbon::now()->year;
        $tanggalPerPeriode = $absensi->getDaysOfCurrentMonth($tanggalMulai,$tanggalSelesai);
        $kalkulasiAbsensi = $absensi->kalkulasiAbsensi($id,$tanggalMulai,$tanggalSelesai);

        $totalmasuk = $kalkulasiAbsensi['totalMasuk'];

        $totalIzin = $kalkulasiAbsensi['totalIzin'];

        $totaltidakmasuk = $kalkulasiAbsensi['totalTidakMasuk'];

        $dataAbsensi = $kalkulasiAbsensi['dataAbsensi'];

        $dataTanggalLibur = TanggalLibur::All();

        $kalkulasi = $absensi->calculateAttendanceMetrics($dataAbsensi);
        $totalTelat = $kalkulasi['totalTelat'];
        $totalPulangCepat = $kalkulasi['totalPulangCepat'];
        $tanggalTelat = $kalkulasi['tanggalTelat'];
        $tanggalPulangCepat = $kalkulasi['tanggalPulangCepat'];
        $karyawan = Karyawan::find($id);

        $title = "Data Absensi Karyawan";

        // Return view with the required data
        return view('admin.show-detail-presensi', compact('title','tanggalTelat','tanggalPulangCepat', 'dataAbsensi', 'karyawan', 'totalmasuk', 'totalIzin', 'totaltidakmasuk', 'dataTanggalLibur','datenow', 'tanggalPerPeriode','tanggalMulai','tanggalSelesai','totalTelat','totalPulangCepat'));
    }

    public function PostKehadiran(Request $request,$tanggal, $id)
    {
        $tanggalparse = $tanggal ?? Carbon::now()->format('Y-m-d');
        $dateQuery = Carbon::create($tanggalparse)->format('Y-m-d');

        // Validasi input
        $request->validate([
            'status_kehadiran' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_input' => 'nullable|mimes:jpg,png,pdf|max:1048',
        ],[
            'file_input.mimes' => 'File harus berupa format jpg, png, atau pdf.',
            'file_input.max' => 'Ukuran file maksimal adalah 1MB.',
        ]);


        // Temukan data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);
        $filePath = $request->hasFile('file_input') ? $request->file('file_input')->store('public/absensi_files'): null;
        // Buat data absensi baru
        $absensi = Absensi::create([
            'karyawan_id' => $id,
            'shift_id' => $karyawan->shift_id,
            'tanggal' => $dateQuery,
            'status_kehadiran' => $request->input('status_kehadiran') ?? null,
            'keterangan' => $request->input('keterangan') ?? null,
            'file_input' => $filePath
        ]);
        $AbsensiTanggal = Carbon::parse($absensi->tanggal)->locale('id')->translatedFormat('d-F-Y');
        // Redirect atau response
        return redirect()->back()->with('success', "Data kehadiran karyawan $karyawan->nama pada tanggal $AbsensiTanggal berhasil diperbarui");
    }
}
