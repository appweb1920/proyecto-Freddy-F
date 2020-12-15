<?php

namespace App\Http\Controllers;

use App\Recetas;
use Illuminate\Http\Request;
use App\IngredientesReceta;
use App\PasosDeReceta;

class RecetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listaRecetas')->with('recetas', Recetas::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function show($idReceta)
    {
        // $receta = $recetas->find($idReceta);
        $receta = Recetas::find($idReceta);
        
        $ingredientesDeReceta = $pasosReceta = null;
        if ( !is_null($receta) ){
            $ingredientesDeReceta = (new IngredientesReceta())->getIngredientesDeReceta($idReceta);
            $pasosReceta = (new PasosDeReceta())->getPasosDeReceta($idReceta);
        }

        return view('verReceta')
                ->with('receta', $receta)
                ->with('ingredientes', $ingredientesDeReceta)
                ->with('pasosReceta', $pasosReceta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function edit(Recetas $recetas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recetas $recetas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recetas $recetas)
    {
        //
    }

}
