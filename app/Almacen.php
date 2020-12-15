<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = "almacen";
    protected $fillable = ['nombreAlmacen', 'descripcion'];

    public function validaCredencialesDeAccesoAlAlmacen($idUsuario, $idUsuarioAlmacen, $idAlmacen)
    {
        //Devuelve un valor distinto de null cuando se encuentran los datos que coinciden con las credenciales.
        return Almacen::join('usuariosAlmacen', 'usuariosAlmacen.idAlmacen', '=', 'almacen.id')
                    ->where('almacen.id', $idAlmacen)
                    ->where('usuariosAlmacen.id', $idUsuarioAlmacen)
                    ->where('usuariosAlmacen.idUsuario', $idUsuario)
                    ->get()->first();
    }
}
