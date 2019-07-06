<?php

namespace DavidVegaCl\LaravelChile\Models;

use Illuminate\Database\Eloquent\Model;
use DavidVegaCl\LaravelChile\Models\Region;

class Comuna extends Model
{
    public function __construct()
    {
        $this->setTable(config('laravelchile.tabla_comunas'));
        return parent::__construct();
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
}
