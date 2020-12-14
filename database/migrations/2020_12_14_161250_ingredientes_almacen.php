<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IngredientesAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientesAlmacen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idIngrediente')
                ->constrained('ingredientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('idAlmacen')
                ->constrained('almacen')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('cantidad');
            $table->float('factorDeConversion');
            $table->string('tipoDeMedicionAlmacen'); //**detalles por resolver...
            $table->boolean('conCaducidad'); //Quizas es mejor en el ingrediente
            $table->date('fechaCaducidad')->nullable();
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
        //Schema::dropIfExists('ingredientesAlmacen');
        Schema::create('ingredientesAlmacen', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
