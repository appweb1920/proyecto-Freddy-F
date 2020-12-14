<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientesAlmacen extends Model
{
    protected $table = "ingredientesAlmacen";
    protected $fillable = ['idIngrediente', 'idAlmacen', 'cantidad', 'factorDeConversion', 'tipoDeMedicionAlmacen', 'conCaducidad', 'fechaCaducidad'];
}
