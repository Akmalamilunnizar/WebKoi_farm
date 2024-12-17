<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class KoiFish extends Model
{
    use HasFactory;

    protected $table = 'koi_fish';

    protected $fillable = [
        'name',
        'jenis',
        'img',
        'umur',
    ];

    // protected $attributes = [
    //      // Default value
    // ];

    protected $casts = [
        'umur' => 'integer',
    ];

    /**
     * Relation to the `JenisKoi` model (BelongsTo)
     */
    public function jenisKoi()
    {
        return $this->belongsTo(JenisKoi::class, 'jenis_koi', 'id');
    }

    /**
     * Relation to the `Pond` model (BelongsTo)
     */
    public function pond()
    {
        return $this->belongsTo(Pond::class, 'pond_id')->withDefault();
    }

    /**
     * Relation to the `Penyakit` model through `DiagnosaPenyakit` (HasManyThrough)
     */
    public function penyakit()
    {
        return $this->hasManyThrough(
            Penyakit::class,
            DiagnosaPenyakit::class,
            'id_koi',
            'id',
            'id',
            'id_penyakit'
        );
    }

    /**
     * Relation to the `DiagnosaPenyakit` model (HasMany)
     */
    public function diagnosaPenyakit()
    {
        return $this->hasMany(DiagnosaPenyakit::class, 'id_koi', 'id');
    }

    /**
     * Many-to-Many relation to the `Pond` model through `detail_koi`
     */
    public function ponds()
    {
        return $this->belongsToMany(
            Pond::class,
            'detail_koi',
            'fish_id',
            'pond_id'
        );
    }

    /**
     * Get the image attribute with a default value if null.
     */
    public function getImgAttribute($value)
    {
        return $value ?: 'path/to/default/image.png';
    }

    /**
     * Computed attribute for pond name.
     */
    public function getPondNameAttribute()
    {
        return $this->pond ? $this->pond->name : 'No Pond Assigned';
    }

    /**
     * Scopes for filtering
     */
    public function scopeWithoutDiagnoses($query)
    {
        return $query->whereDoesntHave('diagnosaPenyakit');
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}
