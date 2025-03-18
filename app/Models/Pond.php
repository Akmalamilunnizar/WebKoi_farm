<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    // use DefaultDatetimeFormat;
    //table name
    protected $fillable = [
        'id',
        'name',
        'volume',
        'created_at',
        'updated_at',
        'img',
        'jml_ikan',
        'relay_condition'
    ];

    protected $table = 'ponds';

    public function getRecent(){
        return $this->limit(5)->orderBy('id', 'DESC')->get();
    }

    public function sensors()
{
    return $this->hasMany(Sensor::class, 'pond_id')->orderBy('created_at', 'DESC');
}



    // Many-to-many relationship with koi_fish
    public function koiFish()
    {
        return $this->belongsToMany(KoiFish::class, 'detail_koi', 'pond_id', 'fish_id');
    }



}
