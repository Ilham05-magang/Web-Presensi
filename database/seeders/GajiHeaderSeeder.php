<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GajiHeader;
use App\Models\GajiKaryawan;

class GajiHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gajiKaryawanRecords = GajiKaryawan::all();

        // Define dummy data for $gajiHeader
        $gajiHeaderData = [
            [
                'nama' => 'Total Hadir',
                'value' => '19'
            ],
            [
                'nama' => 'Total Tidak Masuk',
                'value' => '1'
            ],
            [
                'nama' => 'Terlambat',
                'value' => '2'
            ],
            [
                'nama' => 'Total Disiplin',
                'value' => '17'
            ]
        ];

        // Seed data for each GajiKaryawan record
        foreach ($gajiKaryawanRecords as $gaji) {
            foreach ($gajiHeaderData as $data) {
                GajiHeader::create([
                    'gaji_id' => $gaji->id, // Ensure 'gaji_id' is the correct foreign key
                    'name' => $data['nama'],
                    'value' => $data['value'],
                ]);
            }
        }
    }
}
