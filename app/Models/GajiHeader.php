<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiHeader extends Model
{
    use HasFactory;
    protected $table = 'gaji_headers';

    protected $fillable = [
        'gaji_id',
        'name',
        'value',
    ];

    public function GajiKaryawan()
    {
        return $this->belongsTo(GajiKaryawan::class, 'gaji_id');
    }
}
