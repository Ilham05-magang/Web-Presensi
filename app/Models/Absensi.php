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

        foreach ($dataAbsensi as $absensi) {
            // Check for late arrival
            if (!in_array($absensi->tanggal, $tanggalTelat)) {
                if ($absensi->jam_mulai > $absensi->shift->jam_mulai && $absensi->jam_mulai) {
                    $tanggalTelat[] = $absensi->tanggal;
                    $totalTelat++;
                    continue;
                }
            }

            // Check for early departure
            if ($absensi->jam_pulang < $absensi->shift->jam_pulang && $absensi->jam_pulang) {
                if (!in_array($absensi->tanggal, $tanggalPulangCepat)) {
                    $tanggalPulangCepat[] = $absensi->tanggal;
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
