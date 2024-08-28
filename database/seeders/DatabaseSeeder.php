<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //jangan ubah Urutan pemanggilan
        $this->call([
            SeederRoles::class,
            SeederUser::class,
            SeederAdmin::class,
            SeederShift::class,
            SeederKantor::class,
            SeederDivisi::class,
            Seederkaryawan::class,
            SeederAbsensis::class,
            SeederQuotes::class,
        ]);
    }
}
