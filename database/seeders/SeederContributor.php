<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Contributors;
use App\Models\Instansi;


class SeederContributor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contributorAkun = Roles::where('role', 'Contributor')->first()->id;
        $instansiId = Instansi::where('nama','Universitas Gadjah Mada')->first()->id;

        Contributors::create([
            'akun_id'=>$contributorAkun,
            'instansi_id'=>$instansiId,
            'nama'=>'juplobub',
            'nip'=>'123443134',
            'telepon'=>'1233343'
        ]);
    }
}
