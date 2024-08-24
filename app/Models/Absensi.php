<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'karyawan_id',
        'shift_id',
        'tanggal',
        'jam_mulai',
        'jam_istirahat',
        'jam_izin',
        'jam_selesai_izin',
        'jam_selesai_istirahat',
        'jam_pulang',
        'status_kehadiran',
        'jam_total_produktif',
        'status_kehadiran',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
