<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaPenyakit extends Model
{
    use HasFactory;

    protected $table = 'diagnosa_penyakit';

    protected $fillable = [
        'id',
        'jenis_koi',
        'penyakit',
        'penyebab',
        'gambar_koi',
        'keterangan',
        'created_at',
        'updated_at'
    ];
}
