<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    use HasFactory;
    protected $fillable = [
        'akun_id',
        'nama',
        'telepon'
    ];
    public function user() {
        return $this->hasOne(Users::class,'id', 'akun_id');
    }

}
