<?php

namespace App\Http\Controllers;

use App\Almacen;
use Illuminate\Http\Request;

use App\UsuariosAlmacen;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUsuario)
    {
        //Obten los ID de los almacenes donde este el usuario
        $idAlmacenes = UsuariosAlmacen::where('idUsuario', $idUsuario)->get('idAlmacen');
        
        //Obten los Almacenes con determinadas ID.
        $almacenes = Almacen::whereIn('id', $idAlmacenes)->get();
        
        return view('verAlmacenes')->with('almacenes', "dato");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/crearAlmacen");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Almacen = new Almacen();
        $Almacen->nombreAlmacen = $request->nombreAlmacen;
        $Almacen->descripcion = $request->descripcion;
        //Guardar y crear al propietario
        if ($Almacen->save()){
            $usuarioAlmacen = new UsuariosAlmacen();
            $usuarioAlmacen->idUsuario = $request->idUsuario; //Propietario
            $usuarioAlmacen->idAlmacen = $Almacen->id;
            $usuarioAlmacen->tipoDeAcceso = "propietario";
            $usuarioAlmacen->save();
            //NOTA: Pendiente ver donde crear y ASIGNAR EL ROL
            // return redirect("/almacen/{id}");
            return redirect('/misAlmacenes/'.$request->idUsuario);
        } else {
            $mensaje = "No se ha podido completar la petición, intente más tarde.";
            return view("/crearAlmacen")->with('mensaje', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almacen $almacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        //
    }
}
