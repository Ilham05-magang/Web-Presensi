<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akuns;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class SeederAkun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internRoleId = Roles::where('role', 'intern')->first()->id;
        $adminRoleId = Roles::where('role', 'admin')->first()->id;
        $contributorRoleId = Roles::where('role', 'contributor')->first()->id;

        Akuns::create([
            'role_id' => $internRoleId,
            'username' => 'intern',
            'email' => 'intern@example.com',
            'password' => Hash::make('12345'),
            'status_akun' => true,
        ]);

        Akuns::create([
            'role_id' => $adminRoleId,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'),
            'status_akun' => true,
        ]);

        Akuns::create([
            'role_id' => $contributorRoleId,
            'username' => 'contributor',
            'email' => 'contributor@example.com',
            'password' => Hash::make('12345'),
            'status_akun' => true,
        ]);
    }
}
