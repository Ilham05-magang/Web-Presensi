<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'divisi',
        'icon'
    ];
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'divisi_id');
    }
}
