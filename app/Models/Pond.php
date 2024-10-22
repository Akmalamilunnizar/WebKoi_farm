<?php
namespace App\Models;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    // use DefaultDatetimeFormat;
    //table name
    protected $fillable = [
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

}
