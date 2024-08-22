<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
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
        $karyawanID = Karyawan::findOrFail(1)->id;
        $shift = Shift::find(Karyawan::findOrFail($karyawanID)->shift_id);

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
        
        for ($i = 1; $i <= 5; $i++) {
            Absensi::create([
                'karyawan_id' => $i,
                'shift_id' => rand(1, 3),
                'tanggal' => Carbon::now()->format('Y-m-d'), // Format tanggal sesuai dengan penyimpanan di database
                'jam_mulai' => Carbon::createFromFormat('H:i:s', '09:00:00'),
                'jam_istirahat' => Carbon::createFromFormat('H:i:s', '12:15:00'),
                'jam_selesai_istirahat' => Carbon::createFromFormat('H:i:s', '13:00:00'),
                'jam_pulang' => Carbon::createFromFormat('H:i:s', '17:00:00'),
            ]);
        }

    }
}
