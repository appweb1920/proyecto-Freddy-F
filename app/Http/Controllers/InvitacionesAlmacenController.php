<?php

namespace App\Http\Controllers;

use App\InvitacionesAlmacen;
use Illuminate\Http\Request;


use App\UsuariosAlmacen;
// use App\Almacen;
use App\User;

class InvitacionesAlmacenController extends Controller
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
        //NOTA:Puede ser necesario verificar si existe un registro con esos datos.
        // use App\Almacen;
        // use App\UsuariosAlmacen;

        //Verifica que el registro con los datos indicados exista.
        $datosValidacion = UsuariosAlmacen::where('usuariosAlmacen.id', $idUsuarioAlmacen)
                            ->join('almacen', 'usuariosAlmacen.idAlmacen', '=', 'almacen.id')
                            ->where('almacen.id', $idAlmacen)
                            ->where('usuariosAlmacen.idUsuario', $idUsuario)
                            ->get()->first();

        $validacion = (is_null($datosValidacion))? false:true;

        return view('/crearInvitacion')
            ->with('validacion', $validacion)
            ->with('idUsuario', $idUsuario)
            ->with('idUsuarioAlmacen',$idUsuarioAlmacen)
            ->with('idAlmacen',$idAlmacen);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invitacion = new InvitacionesAlmacen();
        $invitacion->idAlmacen = $request->idAlmacen;
        $invitacion->idUsuarioPropietario = $request->idUsuarioPropietario;
        $invitacion->emailUsuarioInvitado = $request->emailUsuarioInvitado;
        $invitacion->tipoDeAcceso = $request->tipoDeAcceso;
        
        //Verifica que el Email es de un usuario registrado
        $validEmail = User::where('email', $request->emailUsuarioInvitado)->get()->first();
        if( !is_null($validEmail) )
            if($invitacion->save())
                return redirect()->back()->with('invitacionEnviada', "La invitación fue enviada correctamente.");
        return redirect()->back()->with('invitacionNoEnviada', "No se logro ralizar el envío.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function show(InvitacionesAlmacen $invitacionesAlmacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function edit(InvitacionesAlmacen $invitacionesAlmacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvitacionesAlmacen $invitacionesAlmacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvitacionesAlmacen $invitacionesAlmacen)
    {
        //
    }
}
