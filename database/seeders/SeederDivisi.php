<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Divisi;

class SeederDivisi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisi::create(['divisi' => 'UI/UX', 'icon' =>'ri-pen-nib-line']);
        Divisi::create(['divisi' => 'Programming', 'icon'=>'ri-code-s-slash-line']);
        Divisi::create(['divisi' => 'administrasi']);
        Divisi::create(['divisi' => 'HR']);
        Divisi::create(['divisi' => 'Marketing']);
        Divisi::create(['divisi' => 'Digital marketing']);
    }
}
