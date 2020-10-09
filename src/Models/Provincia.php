<?php

namespace DavidVegaCl\LaravelChile\Models;

use Illuminate\Database\Eloquent\Model;
use DavidVegaCl\LaravelChile\Models\Region;
use DavidVegaCl\LaravelChile\Models\Comuna;

class Provincia extends Model
{
    public function __construct()
    {
        $this->setTable(config('laravelchile.tabla_provincias'));
        return parent::__construct();
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }

    public function comunas()
    {
        return $this->hasMany(Comuna::class, 'provincia_id', 'id');
    }
}
