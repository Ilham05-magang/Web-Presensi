<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Divisi;
use App\Models\Kantor;
use App\Models\Shift;
use App\Models\Karyawan;

class SeederKaryawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan ID berdasarkan nama/role
        $akun_id = Roles::where('role', 'karyawan')->first()->id;
        $kantor_id = Kantor::where('nama', 'kantor 1')->first()->id;
        $divisi_id = Divisi::where('divisi', 'Programming')->first()->id;
        $shift_id = Shift::where('nama', 'Shift Pagi')->first()->id;

        // Membuat entri baru di tabel interns
        karyawan::create([
            'akun_id' => $akun_id,
            'kantor_id' => $kantor_id,
            'divisi_id' => $divisi_id,
            'shift_id' => $shift_id,
            'nama' => 'juleha',
            'nip' => '343565433',
            'telepon' => '0849313313',
            'ttl' => 'semarang, 13 november 2000'
        ]);
    }
}
