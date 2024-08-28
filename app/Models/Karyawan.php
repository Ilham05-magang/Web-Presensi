<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function shift()  {
        return $this->belongsTo(Shift::class,'shift_id');
    }

    public function kantor(){
        return $this->belongsTo(Kantor::class, 'kantor_id');
    }
    public function divisi(){
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
    public function akun(){
        return $this->belongsTo(Users::class, 'akun_id');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'karyawan_id', 'id');
    }

}
