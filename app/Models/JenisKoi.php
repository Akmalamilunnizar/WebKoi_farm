<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKoi extends Model
{
    use HasFactory;
    protected $table = 'jenis_koi';
    protected $fillable = [
        'id', // ini buat id
        'name',
    ];

    public $timestamps = false;  // Karena tabel jenis_koi tidak menggunakan created_at dan updated_at
    public function jenisKoi()
    {
        return $this->belongsTo(JenisKoi::class, 'jenis_koi');
    }
}
