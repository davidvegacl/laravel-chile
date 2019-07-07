# Laravel Chile

Utilitarios y datos para utilizar en proyectos PHP+Laravel con datos chilenos. Contiene actualmente:

- Regiones
- Comunas

Este *package* fue probado en Laravel 5.8.x. Debería funcionar en versiones anteriores.

## Requerimientos

- Laravel Framework 5+

## Instalación

Instalar el *package* mediante composer.

```
composer require davidvegacl/laravel-chile
```

### [Opcional] Configurar plugin

Es posible cambiar las tablas en que se instalan las Regiones y Comunas.

```
php artisan vendor:publish --provider="DavidVegaCl\LaravelChile\LaravelChileServiceProvider"
```

Editar el archivo `/config/laravelchile.php`. (También es posible definirlo en `.env`).

```
'tabla_regiones' => env('TABLA_REGIONES','regiones'),
'tabla_comunas' => env('TABLA_COMUNAS','comunas'),
```

## Insertar los datos (migraciones)

Ejecutar migraciones para agregar las Regiones y Comunas.

```
php artisan migrate
```

## Referencias

* [Regiones y Comunas by @gonzunigad](https://gist.github.com/gonzunigad/96a05e487f97e9d938c82b83d55645c9) - Lista actualizada a 2018 de regiones y comunas 

## Autores

* **David Vega R.** - david@izarus.cl - [Prosys Ingeniería](http://www.prosys.cl)

## Licencia

MIT License - [LICENSE.md](LICENSE.md)
