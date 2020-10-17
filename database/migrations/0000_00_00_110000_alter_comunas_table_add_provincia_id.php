<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterComunasTableAddProvinciaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('laravelchile.tabla_comunas'), function (Blueprint $table) {
            $table->bigInteger('provincia_id')->unsigned();

            $table->foreign('provincia_id')->references('id')->on(config('laravelchile.tabla_provincias'))->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('laravelchile.tabla_comunas'), function (Blueprint $table) {
            $table->dropForeign(config('laravelchile.tabla_comunas').'_provincia_id_foreign');

            $table->dropColumn('provincia_id');
        });
    }
}
