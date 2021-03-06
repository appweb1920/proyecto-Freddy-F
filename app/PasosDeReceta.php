<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasosDeReceta extends Model
{
    protected $table = "pasosDeReceta";
    protected $fillable = ['idReceta', 'numPaso', 'textoPaso'];

    public function getPasosDeReceta($idReceta)
    {
        return PasosDeReceta::where('idReceta', $idReceta)
                    ->orderBy('numPaso')
                    ->get();
    }
}
