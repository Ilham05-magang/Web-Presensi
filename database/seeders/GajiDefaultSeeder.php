<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GajiDefault;

class GajiDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gajiData = [
            ['name' => 'Honor Utama', 'value' => 70000, 'status' => '1'],
            ['name' => 'Hadir Disiplin', 'value' => 20000, 'status' => '2'],
            ['name' => 'lembur Minggu', 'value' => 30000, 'status' => '3'],
            ['name' => 'Bonus PM', 'value' => 50000, 'status' => '4'],
        ];

        for ($i = 1; $i <= 5; $i++) {
            foreach ($gajiData as $data) {
                GajiDefault::create([
                    'karyawan_id' => $i,
                    'name' => $data['name'],
                    'value' => $data['value'],
                    'status' => $data['status'],
                ]);
            }
        }
    }
}
