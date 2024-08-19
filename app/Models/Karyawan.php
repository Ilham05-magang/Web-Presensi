<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'akun_id',
        'kantor_id',
        'divisi_id',
        'shift_id',
        'nama',
        'nip',
        'ttl',
        'telepon',
    ];
}
