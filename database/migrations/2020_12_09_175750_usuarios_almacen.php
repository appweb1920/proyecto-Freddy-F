<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosAlmacen extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariosAlmacen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('idAlmacen')
                ->constrained('almacen')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('tipoDeAcceso');
            //$table->boolean('puedeModificar'); // REVISAR: ¿Definido por el tipo de acceso (o no)?
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
        //Schema::dropIfExists('usuariosAlmacen');
        Schema::create('usuariosAlmacen', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
