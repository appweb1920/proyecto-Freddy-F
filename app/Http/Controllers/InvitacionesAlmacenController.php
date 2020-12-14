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
    public function indexParaAlmacen($idAlmacen)
    {
        try {
            //Devuelve las invitaciones realizadas por los propietarios de un almacén
            $invitaciones = InvitacionesAlmacen::where('idAlmacen', $idAlmacen)
                                        ->join('users', 'users.id', '=', 'invitacionesAlmacen.idUsuarioPropietario')
                                        ->select('invitacionesAlmacen.*', 'users.nickname as remitente')
                                        ->get();

            foreach ($invitaciones as $key => $invitacion) {
                // Valida que las invitaciones sigan (o no) vigentes en un lapso de 7 dias.
                if( now()->diffInDays($invitacion->created_at) >= 7 ){
                    $invitacion->estadoInvitacion = 'vencida';
                    $invitacion->save();
                }
            }
            return $invitaciones;

        } catch (\Throwable $th) {
            return null;
        }
    }

    public function indexParaUsuario($idUsuario)
    {
        try {
            $usuario = User::find($idUsuario);
            
            //Devuelve las invitaciones recibidas por un usuario registrado que no han sido actualizsadas
            $invitaciones = InvitacionesAlmacen::where('emailUsuarioInvitado', $usuario->email)
                                        ->where('estadoInvitacion', '!=','vencida')
                                        ->join('almacen', 'almacen.id', '=', 'invitacionesAlmacen.idAlmacen')
                                        ->join('users', 'users.id', '=', 'invitacionesAlmacen.idUsuarioPropietario')
                                        ->select('invitacionesAlmacen.*', 'users.nickname as remitente', 'almacen.nombreAlmacen')
                                        ->get();

            // Valida que las invitaciones sigan (o no) vigentes en un lapso de 7 dias.    
            foreach ($invitaciones as $key => $invitacion) {
                if( now()->diffInDays($invitacion->created_at) >= 7 ){
                    $invitacion->estadoInvitacion = 'vencida';
                    $invitacion->save();
                }
            }

            return view('verInvitacionedDeUsuario')
                ->with('invitaciones', $invitaciones)
                ->with('idUsuario', $idUsuario);
        } catch (\Throwable $th) {
            return view('verInvitacionedDeUsuario')
                ->with('invitaciones', null)
                ->with('idUsuario', $idUsuario);
        }
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
        if (User::find($request->idUsuarioPropietario)->email == $request->emailUsuarioInvitado)
            return redirect()->back()->with('invitacionNoEnviada', "No se puede seleccionar a si mismo como destinatario.");

        $invitacion = new InvitacionesAlmacen();
        $invitacion->idAlmacen = $request->idAlmacen;
        $invitacion->idUsuarioPropietario = $request->idUsuarioPropietario;
        $invitacion->emailUsuarioInvitado = $request->emailUsuarioInvitado;
        $invitacion->tipoDeAcceso = $request->tipoDeAcceso;
        $invitacion->estadoInvitacion = 'pendiente';

        if($invitacion->save())
            return redirect()->back()->with('invitacionEnviada', "La invitación fue enviada correctamente.");
        return redirect()->back()->with('invitacionNoEnviada', "No se logró realizar el envío.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function show(InvitacionesAlmacen $invitacionesAlmacen)
    {
        //No se muestran de forma independiente, sino en grupo.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function edit(InvitacionesAlmacen $invitacionesAlmacen)
    {
        //No hay una vista unicamente para la edición.
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
        $invitacionesAlmacen = InvitacionesAlmacen::find($request->idInvitacion);
        $invitacionesAlmacen->estadoInvitacion = $request->respuestaInvitacion;
        $invitacionesAlmacen->save();
        //Si acepta la invitación crea el usuario para ese almacen con el tipo de acceso indicado.
        if( $invitacionesAlmacen->estadoInvitacion == 'aceptada' ){
            $usuarioAlmacen = new UsuariosAlmacen();
            $usuarioAlmacen->idUsuario = $request->idUsuario; //Propietario
            $usuarioAlmacen->idAlmacen = $invitacionesAlmacen->idAlmacen;
            $usuarioAlmacen->tipoDeAcceso = $invitacionesAlmacen->tipoDeAcceso;
            $usuarioAlmacen->save();
        }
        return redirect()->back()->with('verInvitaciones', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvitacionesAlmacen  $invitacionesAlmacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, InvitacionesAlmacen $invitacionesAlmacen)
    {
        $invitacionesAlmacen = InvitacionesAlmacen::find($request->idInvitacion);
        $invitacionesAlmacen->delete();
        return redirect()->back()->with('verInvitaciones', true);
    }
}
