<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    protected $table = "ingredientes";
    protected $fillable = ['nombreIngrediente', 'categoria', 'tipoDeMedidaBase'];
}
