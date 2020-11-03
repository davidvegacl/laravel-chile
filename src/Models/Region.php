<?php

namespace DavidVegaCl\LaravelChile\Models;

use Illuminate\Database\Eloquent\Model;
use DavidVegaCl\LaravelChile\Models\Comuna;


class Region extends Model
{
    public function __construct()
    {
        $this->setTable(config('laravelchile.tabla_regiones'));
        return parent::__construct();
    }

    public function comunas()
    {
        return $this->hasMany(Comuna::class,'region_id','id');
    }
    
    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'region_id', 'id');
    }
}
