<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosAlmacen extends Model
{
    protected $table = "usuariosAlmacen";
    protected $fillable = ['idUsuario', 'idAlmacen', 'tipoDeAcceso'];

    public function usuariosDeUnAlmacen($idAlmacen)
    {
        $infoUsuarios = UsuariosAlmacen::where('idAlmacen', $idAlmacen)
                            ->select('idUsuario', 'tipoDeAcceso')
                            ->join('users', 'users.id', '=', 'usuariosAlmacen.idUsuario')
                            ->select('usuariosAlmacen.*', 'users.nombre', 'users.apellidos', 'users.email', 'users.nickname')
                            ->get();

        return $infoUsuarios;
    }
}
