<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;
    protected $table = 'gaji_karyawans';
    protected $fillable = [
        'karyawan_id',
        'periode',
        'method',
        'shift',
        'shift_total',
        'terlambat',
        'pulang_awal',
        'tidak_hadir',
        'lembur_minggu',
        'lembur_total',
        'hadir_disiplin',
        'hadir_total',
        'note',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
    public function gajiDetail()
    {
        return $this->hasMany(GajiDetail::class, 'gaji_id');
    }
    public function gajiHeader()
    {
        return $this->hasMany(GajiHeader::class, 'gaji_id');
    }
}
