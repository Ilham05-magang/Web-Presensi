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
            SeederAkun::class,
            SeederAdmin::class,
            SeederInstansi::class,
            SeederTingkat::class,
            SeederContributor::class,
            SeederKantor::class,
            SeederDivisi::class,
            SeederShift::class,
            SeederIntern::class,
            SeederAbsensi::class,
            SeederAktivitas::class,
        ]);
    }
}
