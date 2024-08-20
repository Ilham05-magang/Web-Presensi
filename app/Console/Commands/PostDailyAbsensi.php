<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Console\Command;
use Carbon\Carbon;

class PostDailyAbsensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:post-daily-absensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post daily absensi data ke database';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $karyawans = Karyawan::all();
        foreach ($karyawans as $karyawan) {
            Absensi::create([
                'karyawan_id' => $karyawan->id,
                'shift_id' => $karyawan->shift_id,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Daily data has been posted.');
    }
}
