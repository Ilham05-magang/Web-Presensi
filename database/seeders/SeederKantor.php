<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kantor;
class SeederKantor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kantor::create([
            'nama' => 'Kantor 1',
            'link_gmaps' => 'https://maps.app.goo.gl/FWsjn39Yp5akgWqm6'
        ]);
        Kantor::create([
            'nama' => 'Kantor 2',
            'link_gmaps' => 'https://maps.app.goo.gl/tdJJgZHgTs9b7SSLA'
        ]);
    }
}
