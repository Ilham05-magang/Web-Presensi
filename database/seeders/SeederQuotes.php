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
use App\Models\Quotes;
use Carbon\Carbon;

class SeederQuotes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['quote' => 'Change your life for a better future'],
            ['quote' => 'Embrace the journey, not just the destination'],
            ['quote' => 'Every day is a new opportunity to grow'],
            ['quote' => 'Success is the sum of small efforts repeated'],
            ['quote' => 'Believe in the power of your dreams']
        ];
        Quotes::insert($data);
    }
}
