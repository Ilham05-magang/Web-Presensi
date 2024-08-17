<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Admins;

class SeederAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminAkun = Roles::where('role', 'admin')->first()->id;

        Admins::create([
            'akun_id' => $adminAkun,
            'nama' => 'admin123',
            'telepon' => '0987636278',
        ]);
    }
}
