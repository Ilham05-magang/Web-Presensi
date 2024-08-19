<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interns;
use App\Models\Aktivitas;

class SeederAktivitas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internId = Interns::where('nim', '43423242314')->first()->id;

        Aktivitas::create([
            'intern_id'=>$internId,
            'tanggal'=>'2024/05/24',
            'aktivitas'=>'melanjutkan mengerjakan tugas project'
        ]);
        Aktivitas::create([
            'intern_id'=>$internId,
            'tanggal'=>'2024/08/20',
            'aktivitas'=>'melanjutkan mengerjakan tugas project untuk database seeder'
        ]);
    }
}
