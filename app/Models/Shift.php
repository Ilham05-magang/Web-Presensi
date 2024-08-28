<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jam_mulai',
        'jam_istirahat',
        'jam_selesai_istirahat',
        'jam_pulang',
        'jam_total_produktif',
    ];
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'kantor_id');
    }
}
