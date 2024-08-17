<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Interns extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $fillable = [
        'akun_id',
        'kantor_id',
        'instansi_id',
        'divisi_id',
        'shift_id',
        'nama',
        'nim',
        'ttl',
        'telepon',
    ];

    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    //     'status_akun' => 'boolean',
    // ];
}
