<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosAlmacen extends Model
{
    protected $table = "usuariosAlmacen";
    protected $fillable = ['nombreAlmacen', 'tipoDeAcceso'];
}
