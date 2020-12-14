<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IngredientesReceta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientesReceta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idIngrediente')
                ->constrained('ingredientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('idReceta')
                ->constrained('recetas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('cantidad');
            $table->string('tipoDeCantidad'); //*detalles por resolver
            $table->string('tipoDeMedida'); //*detalles por resolver
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
        //Schema::dropIfExists('ingredientesReceta');
        Schema::create('ingredientesReceta', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
