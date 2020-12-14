<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientesReceta extends Model
{
    protected $table = "ingredientesReceta";
    protected $fillable = ['idIngrediente', 'idReceta', 'cantidad', 'tipoDeCantidad', 'tipoDeMedida'];
}
