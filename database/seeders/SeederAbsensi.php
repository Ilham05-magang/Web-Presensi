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
        $karyawanID = Karyawan::where('nip', '343565433')->first()->id;
        $shift = Shift::where('nama', 'Shift pagi')->first();
        $jam_mulai = $shift->jam_mulai;

        Absensi::create([
            'karyawan_id' => $karyawanID,
            'shift_id' => $shift->id,
            'status_kehadiran'=> $jam_mulai ? 'Tidak Masuk' : ' Hadir',
            'tanggal' => Carbon::now()->format('Y-m-d'),
        ]);
    }
}
