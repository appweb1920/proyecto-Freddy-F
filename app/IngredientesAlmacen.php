<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientesAlmacen extends Model
{
    protected $table = "ingredientesAlmacen";
    protected $fillable = ['idIngrediente', 'idAlmacen', 'cantidad', 'factorDeConversion', 'tipoDeMedicionAlmacen', 'conCaducidad', 'fechaCaducidad'];

    public function ingredientesDeAlmacen($idAlmacen)
    {
        return IngredientesAlmacen::where('idAlmacen', $idAlmacen)
                    ->join('ingredientes', 'ingredientesAlmacen.id', '=', 'ingredientes.id')
                    ->select('ingredientesAlmacen.*', 'ingredientes.nombreIngrediente', 'ingredientes.categoria')
                    //->groupBy('ingredientes.categoria') //op.1
                    //->groupBy('ingredientes.nombre') //op.2
                    //->groupBy('ingredientes.tipoMedidaBase') //op.3
                    ->get();
    }
}
