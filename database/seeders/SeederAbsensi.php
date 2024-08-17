<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interns;
use App\Models\Shift;
use App\Models\Absensi;
use Carbon\Carbon;

class SeederAbsensi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internID = Interns::where('nim', '43423242314')->first()->id;
        $shift = Shift::where('nama', 'Shift pagi')->first();

        $jamDefaultMulai = Carbon::createFromFormat('H:i:s', $shift->jam_mulai);
        $jamDefaultPulang = Carbon::createFromFormat('H:i:s', $shift->jam_pulang);

        $jamMulai = Carbon::createFromFormat('H:i:s', '06:26:00');
        $jamPulang = Carbon::createFromFormat('H:i:s', '13:00:00');

        // Jika jamMulai kurang dari jamDefaultMulai, gunakan jamDefaultMulai
        if ($jamMulai->lessThan($jamDefaultMulai)) {
            $jamMulai = $jamDefaultMulai;
        }

        // Jika jamPulang kurang dari jamDefaultPulang, gunakan jamDefaultPulang
        if ($jamPulang->lessThan($jamDefaultPulang)) {
            $jamPulang = $jamDefaultPulang;
        }

        $jamIstirahatMulai = Carbon::createFromFormat('H:i:s', '00:00:00');
        $jamIstirahatSelesai = Carbon::createFromFormat('H:i:s', '00:00:00');

        // Hitung total waktu kerja
        $totalWaktu = $jamPulang->diffInSeconds($jamMulai);
        // Hitung waktu istirahat
        $waktuIstirahat = $jamIstirahatSelesai->diffInSeconds($jamIstirahatMulai);

        // Hitung waktu produktif
        $jamTotalProduktif = $totalWaktu - $waktuIstirahat;
        $jamTotalProduktifFormatted = gmdate('H:i:s', $jamTotalProduktif);

        Absensi::create([
            'intern_id' => $internID,
            'shift_id' => $shift->id,
            'tanggal' => '2024-08-17', // Format tanggal sesuai dengan penyimpanan di database
            'jam_mulai' => $jamMulai->format('H:i:s'),
            'jam_istirahat' => $jamIstirahatMulai->format('H:i:s'),
            'jam_selesai_istirahat' => $jamIstirahatSelesai->format('H:i:s'),
            'jam_pulang' => $jamPulang->format('H:i:s'),
            'jam_total_produktif' => $jamTotalProduktifFormatted
        ]);
    }
}
