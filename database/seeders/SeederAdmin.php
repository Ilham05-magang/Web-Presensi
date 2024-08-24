<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
use App\Models\Admins;
use App\Models\Users;

class SeederAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminAkun = Users::where('role_id', '2')->first()->id;

        Admins::create([
            'akun_id' => $adminAkun,
            'nama' => 'admin123',
            'telepon' => '0987636278',
        ]);
    }
}
