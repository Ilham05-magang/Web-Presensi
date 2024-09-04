<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Admins;
use App\Models\Absensi;
use App\Models\Divisi;
use App\Models\Shift;
use App\Models\Users;
use App\Models\Kantor;
use App\Models\GajiDefault;
use App\Models\GajiKaryawan;
use App\Models\GajiHeader;
use App\Models\GajiDetail;
use Illuminate\Http\Request;
use App\Models\TanggalLibur;
use Carbon\Carbon;

class GajiController extends Controller
{
    public function gajiAdmin()
    {
        $title = 'Gaji';
        $title2 = 'Data Gaji';
        $karyawan = Karyawan::all();
        return view('admin.gaji.gaji', compact('title', 'title2','karyawan'));
    }
    public function defaultGaji()
    {
        $title = 'Default Gaji';
        $title2 = 'Default Gaji';
        return view('admin.gaji.default-gaji', compact('title', 'title2'));
    }
    public function inputGaji($id)
    {
        $title = 'Gaji Karyawan';
        $tanggalMulai = null;
        $karyawan = Karyawan::where('id', $id)->first();
        return view('admin.gaji.input-gaji', compact('title','karyawan','tanggalMulai'));
    }
    public function SearchInputGaji(Request $request, $id){

        $absensi = new Absensi();
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $date = Carbon::now();
        $datenow = Carbon::parse($date)->locale('id')->translatedFormat('l d-m-Y');
        $tanggalPerPeriode = $absensi->getDaysOfCurrentMonth($tanggalMulai,$tanggalSelesai);
        $kalkulasiAbsensi = $absensi->kalkulasiAbsensi($id,$tanggalMulai,$tanggalSelesai);

        $jumlahHariTanpaMinggu = $absensi->countDaysExceptSundays($tanggalMulai,$tanggalSelesai);
        $result= $absensi->countSundaysBetween($tanggalMulai,$tanggalSelesai);
        $jumlahMinggu = $result['jumlah_minggu'];
        $tanggalMinggu = $result['tanggal_minggu'];


        $absensiLemburHariMinggu = Absensi::whereIn('tanggal', $tanggalMinggu)->count();

        $dataTanggalLibur = TanggalLibur::whereBetween('tanggal_libur', [$tanggalMulai, $tanggalSelesai])
            ->pluck('tanggal_libur')
            ->toArray();
        $absensiLemburTanggalMerah = Absensi::whereIn('tanggal', $dataTanggalLibur)
            ->where('karyawan_id', $id)
            ->count();

        $jumlahTanggalLibur = TanggalLibur::whereBetween('tanggal_libur', [$tanggalMulai, $tanggalSelesai])->count();
        $TotalLibur = $jumlahMinggu + $jumlahTanggalLibur;
        $absensiLemburTotal = $absensiLemburTanggalMerah + $absensiLemburHariMinggu;
        $totalmasuk = $kalkulasiAbsensi['totalMasuk'];

        $totalIzin = $kalkulasiAbsensi['totalIzin'];

        $totaltidakmasuk = $kalkulasiAbsensi['totalTidakMasuk'];

        $dataAbsensi = $kalkulasiAbsensi['dataAbsensi'];


        $kalkulasi = $absensi->calculateAttendanceMetrics($dataAbsensi);
        $totalTelat = $kalkulasi['totalTelat'];
        $totalPulangCepat = $kalkulasi['totalPulangCepat'];
        $tanggalTelat = $kalkulasi['tanggalTelat'];
        $tanggalPulangCepat = $kalkulasi['tanggalPulangCepat'];
        $karyawan = Karyawan::findOrFail($id);
        $gaji = GajiDefault::where('karyawan_id',$id)->get();
        $title = 'Gaji Karyawan';
        return view('admin.gaji.input-gaji', compact('title','jumlahMinggu','jumlahTanggalLibur','absensiLemburTotal','gaji','TotalLibur','jumlahHariTanpaMinggu','TotalLibur', 'karyawan', 'totalmasuk', 'totalIzin', 'totaltidakmasuk','datenow', 'tanggalPerPeriode','tanggalMulai','tanggalSelesai','totalTelat','totalPulangCepat'));
    }

    public function PostGajiKaryawan(Request $request, $id){
        $gajiHeaderName = [];
        $gajiHeaderValue = [];

        $gajiDetailName = [];
        $gajiDetailQTY = [];
        $gajiDetailValue = [];
        $gajiDetailTotalValue = [];

        // Loop through the request data to find custom_x and customValue_x pairs
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'gajiHeaderName')) {
                $gajiHeaderName[] = $value;
            }

            if (str_starts_with($key, 'gajiHeaderValue')) {
                $gajiHeaderValue[] = $value;
            }

            if (str_starts_with($key, 'gajiDetailName')) {
                $gajiDetailName[] = $value;
            }

            if (str_starts_with($key, 'gajiDetailQTY')) {
                $gajiDetailQTY[] = $value;
            }

            if (str_starts_with($key, 'gajiDetailValue')) {
                $gajiDetailValue[] = $value;
            }

            if (str_starts_with($key, 'gajiDetailTotalValue')) {
                // Remove currency symbol
                $cleanedValue = str_replace('Rp', '', $value);

                // Remove non-breaking spaces
                $cleanedValue = str_replace("\u{A0}", '', $cleanedValue);

                // Remove thousands separator
                $cleanedValue = str_replace('.', '', $cleanedValue);

                // Replace comma with dot for decimal point
                $cleanedValue = str_replace(',', '.', $cleanedValue);

                // Convert to numeric value
                $numericValue = (float) $cleanedValue;

                // Remove trailing zeros and unnecessary decimal point
                $formattedValue = rtrim(rtrim(number_format($numericValue, 2, '.', ''), '0'), '.');

                // If the number is now an integer, convert it to an integer
                if (strpos($formattedValue, '.') === false) {
                    $formattedValue = (int) $formattedValue;
                } else {
                    $formattedValue = (float) $formattedValue;
                }

                $gajiDetailTotalValue[] = $formattedValue;
            }

        }

        $gajiHeaderCount = count($gajiHeaderName);
        $gajiDetailCount = count($gajiDetailName);
        $karyawan = Karyawan::findOrFail($id);

        $gajiKaryawan = GajiKaryawan::create([
            'karyawan_id' => $id,
            'periode' => $request->input('Periode'),
            'method' => $request->input('MetodePembayaran'),
            'shift' => $request->input('ShiftPeriode'),
            'shift_total' => $request->input('ShiftTotal'),
            'note' => $request->input('note')
        ]);

        for ($i = 0; $i < $gajiHeaderCount; $i++) {
            GajiHeader::create([
                'gaji_id' => $gajiKaryawan->id,
                'name' => $gajiHeaderName[$i] ?? null,
                'value' => $gajiHeaderValue[$i]??null,
            ]);
        }

        for ($i = 0; $i < $gajiDetailCount; $i++) {
            GajiDetail::create([
                'gaji_id' => $gajiKaryawan->id,
                'name' => $gajiDetailName[$i]??null,
                'multiply' => $gajiDetailQTY[$i]??null,
                'value' => $gajiDetailValue[$i]??null,
                'value_total' => $gajiDetailTotalValue[$i]??null,
            ]);
        }
        $title = 'Gaji Karyawan';
        $tanggalMulai = null;
        $karyawan = Karyawan::where('id', $id)->first();
        return redirect()->route('dashboard.gaji.input', ['id' => $id])
                 ->with('success', "Gaji karyawan $karyawan->nama berhasil di inputkan")
                 ->with(compact('title', 'karyawan', 'tanggalMulai'));

    }


    public function riwayatGaji()
    {

        $title = 'Riwayat Gaji';
        $title2 = 'Riwayat Gaji';
        return view('admin.gaji.riwayat-gaji', compact('title', 'title2'));
    }
}
