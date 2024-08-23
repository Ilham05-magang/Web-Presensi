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

    public function shift(): BelongsTo {
        return $this->belongsTo(Shift::class,'shift_id', 'id');
    }

    public function kantor(): HasOne {
        return $this->hasOne(Kantor::class,'id', 'kantor_id');
    }
}
