<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalLibur extends Model
{
    protected $fillable = [
        "tanggal_libur",
    ];
    use HasFactory;
}
