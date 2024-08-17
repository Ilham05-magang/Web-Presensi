<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instansi;

class SeederInstansi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instansi::create([
            'nama'=> 'SMK Penerbangan AAG Adisutjipto',
            'telepon'=>'(0274)488385',
            'alamat'=>'Komplek Lanud Adisutjipto, Jl. Raya Janti, Karang Janbe, Maguwoharjo, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281',
            'link_gmaps'=>'https://maps.app.goo.gl/Ccds9vPyWBEcP9Pz9'
        ]);
        Instansi::create([
            'nama'=> 'Universitas Gadjah Mada',
            'telepon'=>'(0274)588688',
            'alamat'=>'Bulaksumur, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281',
            'link_gmaps'=>'https://maps.app.goo.gl/2cQfQK7DPfJCvnC87'
        ]);
    }
}
