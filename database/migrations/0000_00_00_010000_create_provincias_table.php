<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(config('laravelchile.tabla_provincias'))) {
            Schema::create(config('laravelchile.tabla_provincias'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nombre');
                $table->bigInteger('region_id')->unsigned();
                $table->timestamps();

                $table->foreign('region_id')->references('id')->on(config('laravelchile.tabla_regiones'))->onDelete('CASCADE')->onUpdate('CASCADE');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('laravelchile.tabla_provincias'));
    }
}
