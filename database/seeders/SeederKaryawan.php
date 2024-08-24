<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Divisi;
use App\Models\Kantor;
use App\Models\Shift;
use App\Models\Karyawan;
use Carbon\Carbon;

class SeederKaryawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Solo', 'Makassar', 'Pontianak', 'Banjarmasin'];
        $name = [
            'Juleha', 'Ahmad', 'Rifki', 'Siti', 'Arief', 'Reni', 'Imam', 'Eko', 'Yeni', 'Tia'
        ];

        $month = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $data = [];
        for ($i=1; $i<=10; $i++){
            $tahun = rand(1995, 2005);
            $data[] = [
                'akun_id' => $i,
                'kantor_id' => rand(1,2),
                'divisi_id' => rand(1,6),
                'shift_id' => rand(1,3),
                'nama' => $name[$i-1],
                'nip' => rand(100000000, 999999999),
                'telepon' => '08'.rand(1000000000, 9999999999),
                'ttl' => $city[rand(0, count($city)-1)].', '.rand(1, 31).' '.$month[rand(0, count($month)-1)].' '.$tahun
            ];
        }
        Karyawan::insert($data);
    }
}
