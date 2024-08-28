<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'link_gmaps'
    ];
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'kantor_id');
    }
}
