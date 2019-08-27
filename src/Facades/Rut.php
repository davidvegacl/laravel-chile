<?php namespace DavidVegaCl\LaravelChile\Facades;
/**
 * Author: David Vega
 * Email: david@izarus.cl
 * Date: 27-08-2019
 */
use Illuminate\Support\Facades\Facade;
class Rut extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rut';
    }
}