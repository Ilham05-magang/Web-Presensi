<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    protected $casts = [
        'tanggal' => 'date:Y-m-d',
    ];
    protected $fillable = [
        'intern_id',
        'tanggal',
        'aktivitas',
    ];
}
