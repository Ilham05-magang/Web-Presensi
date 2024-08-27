<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\TanggalLibur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function PresensiAdmin()
    {
        $dateQuery = Carbon::now()->format('Y-m-d');
        $datenow = Carbon::now()->format('d-m-Y');
        $totalkaryawan = Karyawan::All()->count();

        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])->get();
        $dataTanggalLibur = TanggalLibur::All();

        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = $totalkaryawan - $totalmasuk - $totalIzin;

        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';
        return view('admin.Presensi', compact('title', 'title2', 'datenow', 'dataAbsensi', 'totalmasuk', 'totaltidakmasuk', 'totalIzin', 'dataTanggalLibur'));
    }

    public function SearchPresensiAdmin(Request $request)
    {
        $datenow = Carbon::now()->format('d-m-Y');
        $dateQuery = Carbon::now()->format('Y-m-d');
        $searchQuery = $request->input('query');

        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])
            ->where('nama', 'LIKE', '%' . $searchQuery . '%') // Filter by employee name
            ->get();
        $dataTanggalLibur = TanggalLibur::All();
        $totalkaryawan = Karyawan::All()->count();
        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = $totalkaryawan - $totalmasuk - $totalIzin;
        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';
        return view('admin.Presensi', compact('title', 'title2', 'totalIzin', 'datenow', 'dataAbsensi', 'totalmasuk', 'totaltidakmasuk', 'dataTanggalLibur'));
    }
    public function SearchPresensibyDateAdmin(Request $request)
    {
        $datenow = Carbon::now()->format('d-m-Y');
        // Use Carbon to get the current date in the correct format for comparison
        $dateQuery = $request->input('date', Carbon::now()->format('Y-m-d'));

        // Fetch karyawan with absensi for the specified date
        $dataAbsensi = Karyawan::with(['absensi' => function ($query) use ($dateQuery) {
            $query->whereDate('tanggal', $dateQuery);
        }])->get();
        $dataTanggalLibur = TanggalLibur::All();

        // Calculate totals
        $totalkaryawan = Karyawan::All()->count();
        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')->whereDate('tanggal', $dateQuery)->count();
        $totalIzin = Absensi::where('status_kehadiran', 'Izin')->whereDate('tanggal', $dateQuery)->count();
        $totaltidakmasuk = $totalkaryawan - $totalmasuk - $totalIzin;

        // Set title variables
        $title = 'Presensi Karyawan';
        $title2 = 'Data Presensi Karyawan';

        // Return the view with compacted variables
        return view('admin.Presensi', compact('title', 'title2', 'totalIzin', 'datenow', 'dataAbsensi', 'totalmasuk', 'totaltidakmasuk', 'dataTanggalLibur'));
    }

    private function kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat, $jamIzin, $jamSelesaiIzin)
    {
        $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulai);
        $jamPulang = Carbon::createFromFormat('H:i:s', $jamPulang);
        $jamIstirahat = Carbon::createFromFormat('H:i:s', $jamIstirahat);
        $jamSelesaiIstirahat = Carbon::createFromFormat('H:i:s', $jamSelesaiIstirahat);
        $jamIzin = Carbon::createFromFormat('H:i:s', $jamIzin);
        $jamSelesaiIzin = Carbon::createFromFormat('H:i:s', $jamSelesaiIzin);

        // Hitung durasi kerja dan istirahat dalam detik
        $durasiKerja = $jamPulang->diffInSeconds($jamMulai);
        $durasiIzin = $jamSelesaiIzin->diffInSeconds($jamIzin);
        $durasiIstirahat = $jamSelesaiIstirahat->diffInSeconds($jamIstirahat);

        $totalProduktif = $durasiKerja - $durasiIstirahat - $durasiIzin;

        // Konversi detik ke format H:i:s
        $jam = floor($totalProduktif / 3600);
        $menit = floor(($totalProduktif % 3600) / 60);
        $detik = $totalProduktif % 60;

        return sprintf('%02d:%02d:%02d', $jam, $menit, $detik);
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
        ]);

        $absensi = Absensi::findOrFail($id);

        $jamMulai = $request->input('jam_mulai') ?? $absensi->jam_mulai ?? '00:00:00';
        $jamPulang = $request->input('jam_pulang')?? $absensi->jam_pulang ?? '00:00:00';
        $jamIstirahat = $request->input('jam_istirahat')?? $absensi->jam_istirahat ?? '00:00:00';
        $jamSelesaiIstirahat = $request->input('jam_selesai_istirahat')?? $absensi->jam_selesai_istirahat ?? '00:00:00';
        $jamIzin = $request->input('jam_izin')?? $absensi->jam_izin ?? '00:00:00';
        $jamSelesaiIzin = $request->input('jam_selesai_izin')?? $absensi->jam_selesai_izin ?? '00:00:00';
        $waktuProduktif = $this->kalkulasiTotalProduktif($jamMulai, $jamPulang, $jamIstirahat, $jamSelesaiIstirahat, $jamIzin, $jamSelesaiIzin);

        $absensi->update([
            'jam_mulai' => $jamMulai,
            'jam_istirahat' => $jamIstirahat,
            'jam_izin' => $jamIzin,
            'jam_selesai_izin' => $jamSelesaiIzin,
            'jam_selesai_istirahat' => $jamSelesaiIstirahat,
            'jam_pulang' => $jamPulang,
            'jam_total_produktif' => $waktuProduktif,
            'status_kehadiran' => $request->input('status_kehadiran'),
        ]);
        return redirect()->back()->with('success', 'Data Absensi berhasil diedit');
    }
    public function DeleteAbsensi($id){
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->back()->with('success', 'Data Absensi berhasil dihapus');
    }

    private function getDaysWithoutSundaysBeforeToday($month, $year) {
        // Buat tanggal pertama bulan dan tahun yang diberikan
        $startDate = Carbon::create($year, $month, 1);
        // Buat tanggal terakhir bulan tersebut
        $endDate = $startDate->copy()->endOfMonth();
        // Buat tanggal hari ini
        $today = Carbon::now();

        // Jika hari ini berada di luar bulan yang diberikan, ubah tanggal hari ini ke tanggal terakhir bulan tersebut
        if ($today->month != $month || $today->year != $year) {
            $today = $endDate;
        }

        // Salin tanggal hari ini untuk perhitungan
        $todayCopy = $today->copy();

        $daysCount = 0;

        // Loop melalui setiap hari dalam bulan
        while ($startDate->lte($todayCopy)) {
            // Tambah hitungan jika hari tersebut bukan Minggu (Carbon::SUNDAY)
            if ($startDate->dayOfWeek != Carbon::SUNDAY) {
                $daysCount++;
            }
            $startDate->addDay();
        }

        return $daysCount;
    }

    public function ShowDetailAbsensi($id)
    {
        $selectedMonth = Carbon::now()->format('m');
        $datenow = Carbon::now();
        $dateQuery = $datenow->format('m-Y');
        $year = $datenow->year;
        $month = $datenow->month;

        $totalHariPerbulan = $this->getDaysWithoutSundaysBeforeToday($month, $year);

        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->count();

        $totalIzin = Absensi::where('status_kehadiran', 'Izin')
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->count();

        $totaltidakmasuk = $totalHariPerbulan - $totalmasuk - $totalIzin;

        $dataAbsensi = Absensi::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->get();
        $dataTanggalLibur = TanggalLibur::All();

        // Fetch karyawan details
        $karyawan = Karyawan::find($id);

        $title = "Data Absensi Karyawan";

        return view('admin.show-detail-presensi', compact('title', 'datenow', 'dataAbsensi', 'karyawan', 'totalmasuk', 'totalIzin', 'totaltidakmasuk', 'selectedMonth', 'dataTanggalLibur'));
    }

    public function SearchAbsensiByMonth(Request $request, $id)
    {
        $selectedMonth = $request->input('month');
        $month = $request->input('month');
        $year = Carbon::now()->year;
        $datenow = Carbon::now();

        $totalHariPerbulan = $this->getDaysWithoutSundaysBeforeToday($month, $year);

        $totalmasuk = Absensi::where('status_kehadiran', 'Masuk')
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->count();

        $totalIzin = Absensi::where('status_kehadiran', 'Izin')
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->count();

        $totaltidakmasuk = $totalHariPerbulan - $totalmasuk - $totalIzin;

        $dataAbsensi = Absensi::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->where('karyawan_id', $id)
            ->get();

        $dataTanggalLibur = TanggalLibur::All();

        $karyawan = Karyawan::find($id);

        $title = "Data Absensi Karyawan";

        // Return view with the required data
        return view('admin.show-detail-presensi', compact('title', 'datenow', 'dataAbsensi', 'karyawan', 'totalmasuk', 'totalIzin', 'totaltidakmasuk', 'selectedMonth', 'dataTanggalLibur'));
    }



}
