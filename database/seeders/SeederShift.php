<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;
use Carbon\Carbon;

class SeederShift extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Shift Pagi
        $jamMulai = Carbon::createFromFormat('H:i:s', '06:30:00');
        $jamPulang = Carbon::createFromFormat('H:i:s', '13:00:00');
        $jamIstirahatMulai = Carbon::createFromFormat('H:i:s', '00:00:00');
        $jamIstirahatSelesai = Carbon::createFromFormat('H:i:s', '00:00:00');

        $totalWaktu = $jamPulang->diffInSeconds($jamMulai);
        $waktuIstirahat = $jamIstirahatSelesai->diffInSeconds($jamIstirahatMulai);

        $jamTotalProduktif = $totalWaktu - $waktuIstirahat;
        $jamTotalProduktifFormatted = gmdate('H:i:s', $jamTotalProduktif);

        Shift::create([
            'nama' => 'Shift Pagi',
            'jam_mulai' => '06:30:00',
            'jam_istirahat' => '00:00:00',
            'jam_selesai_istirahat' => '00:00:00',
            'jam_pulang' => '13:00:00',
            'jam_total_produktif' => $jamTotalProduktifFormatted,
        ]);

        // Shift Middle
        $jamMulai = Carbon::createFromFormat('H:i:s', '09:00:00');
        $jamPulang = Carbon::createFromFormat('H:i:s', '17:00:00');
        $jamIstirahatMulai = Carbon::createFromFormat('H:i:s', '12:15:00');
        $jamIstirahatSelesai = Carbon::createFromFormat('H:i:s', '13:00:00');

        $totalWaktu = $jamPulang->diffInSeconds($jamMulai);
        $waktuIstirahat = $jamIstirahatSelesai->diffInSeconds($jamIstirahatMulai);

        $jamTotalProduktif = $totalWaktu - $waktuIstirahat;
        $jamTotalProduktifFormatted = gmdate('H:i:s', $jamTotalProduktif);

        Shift::create([
            'nama' => 'Shift Middle',
            'jam_mulai' => '09:00:00',
            'jam_istirahat' => '12:15:00',
            'jam_selesai_istirahat' => '13:00:00',
            'jam_pulang' => '17:00:00',
            'jam_total_produktif' => $jamTotalProduktifFormatted,
        ]);

        // Shift Siang
        $jamMulai = Carbon::createFromFormat('H:i:s', '13:00:00');
        $jamPulang = Carbon::createFromFormat('H:i:s', '21:00:00');
        $jamIstirahatMulai = Carbon::createFromFormat('H:i:s', '18:00:00');
        $jamIstirahatSelesai = Carbon::createFromFormat('H:i:s', '19:00:00');

        $totalWaktu = $jamPulang->diffInSeconds($jamMulai);
        $waktuIstirahat = $jamIstirahatSelesai->diffInSeconds($jamIstirahatMulai);

        $jamTotalProduktif = $totalWaktu - $waktuIstirahat;
        $jamTotalProduktifFormatted = gmdate('H:i:s', $jamTotalProduktif);

        Shift::create([
            'nama' => 'Shift Siang',
            'jam_mulai' => '13:00:00',
            'jam_istirahat' => '18:00:00',
            'jam_selesai_istirahat' => '19:00:00',
            'jam_pulang' => '21:00:00',
            'jam_total_produktif' => $jamTotalProduktifFormatted,
        ]);
    }
}
