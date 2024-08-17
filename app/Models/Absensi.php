<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'intern_id',
        'shift_id',
        'jam_mulai',
        'jam_istirahat',
        'jam_selesai_istirahat',
        'jam_pulang',
        'jam_total_produktif',
    ];
}
