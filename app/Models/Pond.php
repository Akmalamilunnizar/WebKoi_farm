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
        'id' => 'integer',
        'name' => 'string',
        'volume' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'img' => 'string',
        'jml_ikan' => 'integer',
        'relay_condition' => 'integer',
        'details_count' => 'integer',
    ];

    public function getRecent()
    {
        return $this->orderBy('id', 'DESC')->limit(5)->get();
    }
}
