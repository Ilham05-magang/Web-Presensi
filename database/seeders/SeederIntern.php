<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Divisi;
use App\Models\Kantor;
use App\Models\Tingkat;
use App\Models\Shift;
use App\Models\Interns;
use App\Models\Instansi;

class SeederIntern extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan ID berdasarkan nama/role
        $akun_id = Roles::where('role', 'intern')->first()->id;
        $kantor_id = Kantor::where('nama', 'kantor 1')->first()->id;
        $divisi_id = Divisi::where('divisi', 'Programming')->first()->id;
        $shift_id = Shift::where('nama', 'Shift Pagi')->first()->id;

        // Mendapatkan ID instansi berdasarkan nama
        $instansi = Instansi::where('nama', 'Universitas Gadjah Mada')->first();
        $instansi_id = $instansi->id;

        // Mendapatkan ID tingkatan berdasarkan instansi_id dan nama tingkatan
        $tingkatan = Tingkat::where('instansi_id', $instansi_id)
                    ->where('tingkatan', 'Diploma D3/D4')
                    ->first();
        $tingkatan_id = $tingkatan->id;

        // Membuat entri baru di tabel interns
        Interns::create([
            'akun_id' => $akun_id,
            'kantor_id' => $kantor_id,
            'instansi_id' => $tingkatan_id,
            'divisi_id' => $divisi_id,
            'shift_id' => $shift_id,
            'nama' => 'juleha',
            'nim' => '43423242314',
            'telepon' => '0849313313',
            'ttl' => 'semarang, 13 november 2000'
        ]);
    }
}
