<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiDefault extends Model
{
    use HasFactory;

    protected $table = 'gaji_defaults';

    protected $fillable = [
        'karyawan_id',
        'name',
        'value',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
