<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;

    protected $table = 'ponds';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'volume',
        'img',
        'jml_ikan',
        'relay_condition'
    ];

    public function getRecent()
    {
        return $this->orderBy('id', 'DESC')->limit(5)->get();
    }
}
