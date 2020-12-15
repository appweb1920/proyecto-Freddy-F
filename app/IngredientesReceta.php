<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientesReceta extends Model
{
    protected $table = "ingredientesReceta";
    protected $fillable = ['idIngrediente', 'idReceta', 'cantidad', 'tipoDeCantidad', 'tipoDeMedida'];

    public function getIngredientesDeReceta($idReceta)
    {
        return IngredientesReceta::where('idReceta', $idReceta)
                    ->join('ingredientes', 'ingredientesReceta.id', '=', 'ingredientes.id')
                    ->select('ingredientesReceta.*', 'ingredientes.nombreIngrediente', 
                             'ingredientes.categoria', 'ingredientes.tipoDeMedidaBase')
                    ->get();
    }
}
