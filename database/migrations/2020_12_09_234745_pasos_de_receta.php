<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PasosDeReceta extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasosDeReceta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idReceta')
                ->constrained('recetas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('numPaso');
            $table->text('txtoPaso');
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
        //Schema::dropIfExists('pasosDeReceta');
        Schema::create('pasosDeReceta', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
