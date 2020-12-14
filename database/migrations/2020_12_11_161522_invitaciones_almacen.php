<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvitacionesAlmacen extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitacionesAlmacen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idAlmacen')
                ->constrained('almacen')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('idUsuarioPropietario')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('emailUsuarioInvitado');
            $table->string('tipoDeAcceso');
            $table->string('estadoInvitacion');
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
        //Schema::dropIfExists('invitacionesAlmacen');
        Schema::create('invitacionesAlmacen', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
