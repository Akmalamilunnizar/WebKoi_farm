<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoiFish extends Model
{
    use HasFactory;

    protected $table = 'koi_fish'; // Nama tabel

    protected $fillable = [
        //'id',
        'name',
        'description',
        'jenis',
        'img',
        'umur',
        'created_at',  // Tanggal dibuat (otomatis ditangani oleh Laravel)
        'updated_at',  // Tanggal diperbarui (otomatis ditangani oleh Laravel)
    ];

    // Tentukan nilai default untuk kolom description jika kosong
    protected $attributes = [
        'description' => '',
    ];

    // Jika timestamps seperti 'created_at' dan 'updated_at' digunakan (default Laravel)
    public $timestamps = true;

    /**
     * Relasi ke model JenisKoi
     */
    public function jenisKoi()
    {
        return $this->belongsTo(JenisKoi::class, 'jenis_koi', 'id');
    }

    /**
     * Relasi ke model Pond
     * (Relasi langsung, jika kolam disimpan sebagai foreign key)
     */
    public function pond()
    {
        return $this->belongsTo(Pond::class, 'pond_id');
    }

    /**
     * Relasi ke model DiagnosaPenyakit (hasMany)   
     */
    public function diagnosaPenyakit()
    {
        return $this->hasMany(DiagnosaPenyakit::class, 'id_koi', 'id');
    }

    /**
     * Relasi ke model Penyakit (hasManyThrough)
     * Menghubungkan melalui DiagnosaPenyakit
     */
    public function penyakit()
    {
        return $this->hasManyThrough(
            Penyakit::class,           // Model tujuan
            DiagnosaPenyakit::class,   // Model perantara
            'id_koi',                  // Foreign key di tabel diagnosa_penyakit
            'id',                      // Foreign key di tabel penyakit
            'id',                      // Primary key di tabel koi_fish
            'id_penyakit'              // Local key di tabel diagnosa_penyakit
        );
    }

    /**
     * Relasi ke model Pond melalui tabel pivot 'detail_koi'
     * (Relasi banyak ke banyak)
     */
    public function ponds()
    {
        return $this->belongsToMany(Pond::class, 'detail_koi', 'fish_id', 'pond_id');
    }
}
