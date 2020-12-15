<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Ingredientes;
use App\IngredientesAlmacen;
use Illuminate\Http\Request;

class ingredientesAlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idUsuario, $idUsuarioAlmacen, $idAlmacen)
    {
        //Buscamos la informacion de almacen junto con los permisos del usuario (de 'usuariosAlmacen')
        // donde los datos de consulta coincidan.
        $validacion = (new Almacen())->validaCredencialesDeAccesoAlAlmacen($idUsuario, $idUsuarioAlmacen, $idAlmacen);

        if(!is_null($validacion)){
            $ingredientesDelAlmacen = (new IngredientesAlmacen())->ingredientesDeAlmacen($idAlmacen)->unique('idIngrediente');
            return view('crearIngredienteParaAlmacen')
                        ->with('idAlmacen', $idAlmacen)
                        ->with('idUsuario', $idUsuario)
                        ->with('idUsuarioAlmacen', $idUsuarioAlmacen)
                        ->with('ingredientesDelAlmacen', $ingredientesDelAlmacen);
        }
        return redirect()->back(); //Si las credenciales no son validas lo regresa
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingrediente = new Ingredientes();
        $ingredienteAlmacen = new ingredientesAlmacen();
        $conCaducidad = false;
        $ingredienteGuardado = false;
        if( $request->usarIngredienteExistente ){
            $ingrediente = Ingredientes::find($request->idIngrediente);
            if( !is_null($ingrediente))
                if($ingrediente->save())
                    $ingredienteGuardado = true;
            return redirect()->back()->with('errorMsg', true);
        }
        else{
            $ingrediente->nombreIngrediente = $request->nombreIngrediente;
            $ingrediente->categoria = $request->categoriaIngrediente;
            $ingrediente->tipoDeMedidaBase = $request->medidaBaseIngrediente;
            if($ingrediente->save())
                $ingredienteGuardado = true;
            dd('hola');
        }
        if($ingredienteGuardado){
            $conCaducidad = (is_null($request->fechaCaducidad))? 0:1;
            $ingredienteAlmacen->idIngrediente = $ingrediente->id;
            $ingredienteAlmacen->idAlmacen = $request->idAlmacen;;
            $ingredienteAlmacen->cantidad = $request->cantidadIngredienteAlmacen;
            $ingredienteAlmacen->factorDeConversion = $request->factorConversionIngredienteAlmacen;
            $ingredienteAlmacen->tipoDeMedicionAlmacen = $request->medidaBaseIngredienteAlmacen;
            $ingredienteAlmacen->conCaducidad = $conCaducidad;
            $ingredienteAlmacen->fechaCaducidad = ($conCaducidad)? $request->fechaCaducidad: null;
            if ($ingredienteAlmacen->save()){
                //  dd($ingredienteAlmacen->conCaducidad);
                $redirectTo = "/misAlmacenes"."/".$request->idUsuarioPropietario."/". $request->idUsuarioAlmacen."/almacen".'/'.$request->idAlmacen;
                return redirect($redirectTo);
            }
        }
        return redirect()->back()->with('errorMsg', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IngredientesAlmacen  $ingredientesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientesAlmacen $ingredientesAlmacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IngredientesAlmacen  $ingredientesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function edit(IngredientesAlmacen $ingredientesAlmacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IngredientesAlmacen  $ingredientesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IngredientesAlmacen $ingredientesAlmacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IngredientesAlmacen  $ingredientesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientesAlmacen $ingredientesAlmacen)
    {
        //
    }
}
