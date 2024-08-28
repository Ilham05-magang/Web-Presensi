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
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04',
            'Mei' => '05', 'Juni' => '06', 'Juli' => '07', 'Agustus' => '08',
            'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];

        $data = [];
        for ($i=1; $i<=10; $i++){
            $tahun = rand(1995, 2005);
            $bulan = array_rand($month); // Ambil bulan secara acak
            $tanggal = rand(1, 28); // Tetap gunakan 28 hari untuk menghindari tanggal yang tidak valid
            $tanggal_lahir = $tahun . '-' . $month[$bulan] . '-' . str_pad($tanggal, 2, '0', STR_PAD_LEFT);

            $data[] = [
                'akun_id' => $i,
                'kantor_id' => rand(1,2),
                'divisi_id' => rand(1,6),
                'shift_id' => rand(1,3),
                'nama' => $name[$i-1],
                'nip' => rand(100000000, 999999999),
                'telepon' => '08'.rand(1000000000, 9999999999),
                'tempat_lahir' => $city[rand(0, count($city)-1)],
                'tanggal_lahir' => $tanggal_lahir
            ];
        }
        Karyawan::insert($data);
    }
}
