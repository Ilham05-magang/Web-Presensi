<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'shift_id',
        'tanggal',
        'jam_mulai',
        'jam_istirahat',
        'jam_izin',
        'jam_selesai_izin',
        'jam_selesai_istirahat',
        'jam_pulang',
        'status_kehadiran',
        'jam_total_produktif',
        'file_input',
        'keterangan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    /**
     * Get days between selected start and end dates.
     *
     * @param string $selectedMulai
     * @param string $tanggalSelesai
     * @return LengthAwarePaginator
     */
    public function getDaysOfCurrentMonth($selectedMulai, $tanggalSelesai)
    {
        // Parse the input dates
        $startDate = Carbon::parse($selectedMulai);
        $endDate = Carbon::parse($tanggalSelesai);

        // Initialize a collection to hold the dates
        $dates = collect();

        // Iterate from the start date to the end date
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates->push($date->toDateString());
        }

        // Paginate the results (40 items per page)
        $paginatedDates = $this->paginateCollection($dates, 40);

        return $paginatedDates;
    }
    public function countSundaysBetween($selectedMulai, $tanggalSelesai)
    {
        $startDate = Carbon::parse($selectedMulai);
        $endDate = Carbon::parse($tanggalSelesai);

        $jumlahminggu = 0;
        $sundays = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            if ($date->isSunday()) {
                $jumlahminggu++;
                $sundays[] = $date->toDateString(); // Menyimpan tanggal hari Minggu
            }
        }

        return [
            'jumlah_minggu' => $jumlahminggu,
            'tanggal_minggu' => $sundays,
        ];
    }


    public function countDaysExceptSundays($selectedMulai, $tanggalSelesai)
    {
        $startDate = Carbon::parse($selectedMulai);
        $endDate = Carbon::parse($tanggalSelesai);

        $haritanpaminggu = 0;

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            if (!$date->isSunday()) {
                $haritanpaminggu++;
            }
        }

        return $haritanpaminggu;
    }


    public static function kalkulasiAbsensi($id, $tanggalMulai, $tanggalSelesai)
    {
        // Calculate the total number of "Masuk"
        $totalMasuk = self::where('status_kehadiran', 'Masuk')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->where('karyawan_id', $id)
            ->count();

        // Calculate the total number of "Izin"
        $totalIzin = self::where('status_kehadiran', 'Izin')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->where('karyawan_id', $id)
            ->count();

        // Calculate the total number of "Tidak Masuk"
        $totalTidakMasuk = self::where('status_kehadiran', 'Tidak Masuk')
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->where('karyawan_id', $id)
            ->count();

        // Retrieve the attendance data for the given date range and employee
        $dataAbsensi = self::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->where('karyawan_id', $id)
            ->get();

        // Return the results in an associative array
        return [
            'totalMasuk' => $totalMasuk,
            'totalIzin' => $totalIzin,
            'totalTidakMasuk' => $totalTidakMasuk,
            'dataAbsensi' => $dataAbsensi,
        ];
    }

    /**
     * Paginate a collection of items.
     *
     * @param Collection $collection
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    protected function paginateCollection(Collection $collection, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }
    /**
     * Calculate the total number of late arrivals and early departures.
     *
     * @param $dataAbsensi
     * @return array
     */
    public static function calculateAttendanceMetrics($dataAbsensi)
    {
        $totalTelat = 0;
        $totalPulangCepat = 0;

        $tanggalTelat = [];
        $tanggalPulangCepat = [];

        // Ambil tanggal libur dari database
        $tanggalLibur = TanggalLibur::pluck('tanggal_libur')->toArray();

        // Tentukan rentang tanggal
        $tanggalMulai = $dataAbsensi->min('tanggal');
        $tanggalSelesai = $dataAbsensi->max('tanggal');

        // Hitung tanggal Minggu dalam rentang waktu
        $tanggalMinggu = [];
        $startDate = Carbon::parse($tanggalMulai);
        $endDate = Carbon::parse($tanggalSelesai);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            if ($date->isSunday()) {
                $tanggalMinggu[] = $date->toDateString();
            }
        }

        foreach ($dataAbsensi as $absensi) {
            // Convert string tanggal to Carbon object if necessary
            $tanggal = Carbon::parse($absensi->tanggal)->toDateString();

            // Skip if the date is a holiday or Sunday
            if (in_array($tanggal, $tanggalLibur) || in_array($tanggal, $tanggalMinggu)) {
                continue;
            }

            // Check for late arrival
            if (!in_array($tanggal, $tanggalTelat)) {
                if ($absensi->jam_mulai > $absensi->shift->jam_mulai && $absensi->jam_mulai) {
                    $tanggalTelat[] = $tanggal;
                    $totalTelat++;
                    continue;
                }
            }

            // Check for early departure
            if ($absensi->jam_pulang < $absensi->shift->jam_pulang && $absensi->jam_pulang) {
                if (!in_array($tanggal, $tanggalPulangCepat)) {
                    $tanggalPulangCepat[] = $tanggal;
                }
                $totalPulangCepat++;
            }
        }

        return [
            'totalTelat' => $totalTelat,
            'totalPulangCepat' => $totalPulangCepat,
            'tanggalTelat' => $tanggalTelat,
            'tanggalPulangCepat' => $tanggalPulangCepat,
        ];
    }

}
