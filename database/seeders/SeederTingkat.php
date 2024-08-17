<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instansi;
use App\Models\Tingkat;
class SeederTingkat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SMK = Instansi::where('nama', 'SMK Penerbangan AAG Adisutjipto')->first()->id;
        $UGM = Instansi::where('nama', 'Universitas Gadjah Mada')->first()->id;

        Tingkat::create(['instansi_id'=>$SMK,'tingkatan' => 'SMK']);
        Tingkat::create([ 'instansi_id'=>$UGM,'tingkatan' => 'Sarjana S1/S2']);
        Tingkat::create(['instansi_id'=>$UGM,'tingkatan' => 'Diploma D3/D4']);
    }
}
