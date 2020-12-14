<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PasosDeReceta;
use App\IngredientesReceta;
use App\Ingredientes;

class Recetas extends Model
{
    protected $table = "recetas";
    protected $fillable = ['nombreReceta', 'categoria', 'numPorciones', 'tiempoPreparacion'];

    public function agregarPasosAReceta($idReceta, $numPaso, $textoPaso)
    {
        $pasosReceta = new PasosDeReceta();
        $pasosReceta->idReceta = $idReceta;
        $pasosReceta->numPaso = $numPaso;
        $pasosReceta->textoPaso = $textoPaso;
        return $pasosReceta->save();
    }

    public function agregarIngredientesAReceta($idReceta, $idIngrediente, $cantidad, $tipoDeCantidad, $tipoDeMedida = null)
    {
        
        $ingredienteReceta = new IngredientesReceta();
        $ingredienteReceta->idIngrediente = $idIngrediente;
        $ingredienteReceta->idReceta = $idReceta;
        $ingredienteReceta->cantidad = $cantidad;
        $ingredienteReceta->tipoDeCantidad = $tipoDeCantidad;
        if ( is_null($tipoDeMedida) )
            $ingredienteReceta->tipoDeMedida = ((new Ingredientes())->find($idIngrediente))->tipoDeMedidaBase;
        else
            $ingredienteReceta->tipoDeMedida = $tipoDeMedida;
        
        return $ingredienteReceta->save();

    }
}