<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeederUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve role IDs for 'karyawan' and 'admin'
        $karyawanRoleId = Roles::where('role', 'karyawan')->first()->id;
        $adminRoleId = Roles::where('role', 'admin')->first()->id;

        // Create a user with the 'karyawan' role
        Users::create([
            'role_id' => $karyawanRoleId,
            'username' => 'karyawan',
            'email' => 'karyawan@example.com',
            'password' => Hash::make('12345'),
            'status_akun' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(20),
        ]);
        // Create a user with the 'admin' role
        Users::create([
            'role_id' => $adminRoleId,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'),
            'status_akun' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
