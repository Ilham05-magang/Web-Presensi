<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GajiDetail;
use App\Models\GajiDefault;
use App\Models\GajiKaryawan;

class GajiDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all GajiDefault records
        $gajiDefaults = GajiDefault::all();

        // Fetch all GajiKaryawan records
        $gajiKaryawanList = GajiKaryawan::all();

        // Iterate through each GajiKaryawan record
        foreach ($gajiKaryawanList as $gaji) {
            // Iterate through each GajiDefault record
            foreach ($gajiDefaults as $default) {
                // Determine multiplier based on the name from GajiDefault
                $multiply = 0;
                switch ($default->status) {
                    case '1':
                        $multiply = $gaji->hadir_total;
                    break;
                    case '2':
                        $multiply = $gaji->hadir_disiplin;
                        break;
                    case '3':
                        $multiply = $gaji->lembur_minggu;
                        break;
                    case '4':
                        $multiply = 1;
                        break;
                }

                // Create a GajiDetail record if it does not exist
                if (!GajiDetail::where('gaji_id', $gaji->id)
                                ->where('name', $default->name)
                                ->exists()) {
                    // Create a GajiDetail record
                    GajiDetail::create([
                        'gaji_id' => $gaji->id,
                        'name' => $default->name,
                        'multiply' => $multiply,
                        'value' => $default->value,
                        'value_total' => $default->value * $multiply,
                    ]);
                }
            }
        }
    }
}
