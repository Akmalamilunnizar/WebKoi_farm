<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoiFish extends Model
{
    use HasFactory;

    protected $table = 'koi_fish'; // Ganti dengan nama tabel yang sesuai

    protected $fillable = [
        // 'id',
        'name',
        'description',
        'jenis',
        'id_penyakit',
        'img',
        'umur',
        'created_at',  // Tanggal dibuat (otomatis ditangani oleh Laravel)
        'updated_at',  // Tanggal diperbarui (otomatis ditangani oleh Laravel)
    ];
    // Menentukan nama kolom primary key (opsional jika kamu menggunakan id sebagai default)
    // protected $primaryKey = 'id'; // Kolom primary key

    // kalo ga mau ingin menggunakan timestamps seperti 'created_at' dan 'updated_at',
    // bisa setel property ini ke false.
    public $timestamps = true; // Jika kamu menggunakan timestamps (defaultnya)


    public function jenisKoi() // Relasi ke model JenisKoi()
    {
        return $this->belongsTo(JenisKoi::class, 'jenis_koi');
        return $this->belongsTo(JenisKoi::class, 'jenis', 'id');
    }

    // A Koi Fish belongs to a Pond
    public function pond()
    {
        return $this->belongsTo(Pond::class, 'pond_id');
    }

    // public function penyakit() // Relasi ke model Penyakit()
    // {
    //     return $this->belongsTo(Penyakit::class, 'penyakit', 'id');
    // }

    // Relasi dengan Penyakit


    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit');
    }

    public function diagnosaPenyakit()
    {
        return $this->hasMany(DiagnosaPenyakit::class, 'id_koi', 'id');
    }


    public function ponds()
    {
        return $this->belongsToMany(Pond::class, 'detail_koi', 'fish_id', 'pond_id');
    }
}
