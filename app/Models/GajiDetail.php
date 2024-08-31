<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiDetail extends Model
{
    use HasFactory;
    protected $table = 'gaji_details';
    protected $fillable = [
        'gaji_id',
        'name',
        'multiply',
        'value',
        'value_total',
    ];
    public function GajiKaryawan()
    {
        return $this->belongsTo(GajiKaryawan::class, 'gaji_id');
    }

}
