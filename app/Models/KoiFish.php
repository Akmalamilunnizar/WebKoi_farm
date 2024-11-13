<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoiFish extends Model
{
    use HasFactory;

    protected $table = 'koi_fish'; // Ganti dengan nama tabel yang sesuai

    protected $fillable = [
    'id',
    'name',
    'description',
    'jenis',
    'penyakit',
    'img',
    'umur',
    'created_at',  // Tanggal dibuat (otomatis ditangani oleh Laravel)
    'updated_at',  // Tanggal diperbarui (otomatis ditangani oleh Laravel)
    ];
    // Menentukan nama kolom primary key (opsional jika kamu menggunakan id sebagai default)
    // protected $primaryKey = 'id'; // Kolom primary key

    // Jika kamu tidak ingin menggunakan timestamps seperti 'created_at' dan 'updated_at',
    // kamu bisa setel property ini ke false.
    public $timestamps = true; // Jika kamu menggunakan timestamps (defaultnya)

}
