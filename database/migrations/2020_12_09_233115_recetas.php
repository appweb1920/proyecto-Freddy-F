<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recetas extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreReceta');
            $table->string('categoria');
            $table->integer('numPorciones');
            $table->integer('tiempoPreparacion'); //Minutos
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
        //Schema::dropIfExists('recetas');
        Schema::create('recetas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
