<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvitacionesAlmacen extends Model
{
    protected $table = "invitacionesAlmacen";
    protected $fillable = ['idAlmacen', 'idUsuarioPropietario', 'emailUsuarioInvitado', 'tipoDeAcceso', 'estadoInvitacion'];
}
