<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ingredientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombreIngrediente');
            $table->string('categoria');
            //$table->float('costoApoxiado'); //Mejor por cada almacen...
            $table->string('tipoDeMedidaBase'); //*detalles por resolver
            //$table->idUsuarioCreador(); //Si los usuarios lo crean //TODO: Definir quien lo hará: usuarios, admin, ambos?
            //Falta imagen(es) -> Si son varias otra tabla para la(s) rutas de guardado
            //Falta dificultad -> ¿Opcional?
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('ingredientes');
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
