<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GajiKaryawan;

class GajiKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define dummy data for $gajiKaryawan
        $gajiKaryawan = [
            [
                'periode' => '26 Agt - 26 September 2024',
                'method' => 'transfer',
                'shift' => 'morning',
                'shift_total' => 20,
                'note' => 'Good performance'
            ]
        ];

        for ($i = 1; $i <= 5; $i++) {
            foreach ($gajiKaryawan as $data) {
                GajiKaryawan::create([
                    'karyawan_id' => $i, // Assumes you are assigning this data to 5 different employees
                    'periode' => $data['periode'],
                    'method' => $data['method'],
                    'shift' => $data['shift'],
                    'shift_total' => $data['shift_total'],
                    'note' => $data['note'],
                ]);
            }
        }
    }
}
