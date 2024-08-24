<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interns;
use App\Models\Aktivitas;
use Carbon\Carbon;

class SeederAbsensis extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Absensi::create([
                'karyawan_id' => $i,
                'shift_id' => rand(1, 2),
                'tanggal' => Carbon::now()->format('Y-m-d'), // Format tanggal sesuai dengan penyimpanan di database
                'jam_mulai' => Carbon::createFromFormat('H:i:s', '09:00:00'),
                'jam_istirahat' => Carbon::createFromFormat('H:i:s', '12:15:00'),
                'status_kehadiran' => 'Masuk',
                'jam_selesai_istirahat' => Carbon::createFromFormat('H:i:s', '13:00:00'),
                'jam_pulang' => Carbon::createFromFormat('H:i:s', '17:00:00'),
            ]);
        }
    }
}
