<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('laravelchile.tabla_comunas'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('region_id')->unsigned();
            $table->string('nombre');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on(config('laravelchile.tabla_regiones'))->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('laravelchile.tabla_comunas'));
    }
}
