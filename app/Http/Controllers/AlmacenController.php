<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\InvitacionesAlmacen;
use Illuminate\Http\Request;

use App\UsuariosAlmacen;
use App\Http\Controllers\InvitacionesAlmacenController;
use App\IngredientesAlmacen;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUsuario)
    {
        // Obtenemos los ID de los almacenes a los que tiene el usuario, y el tipo de acceso.
        // Luego unimos la información de los almacenes que tienen esos ID.
        // (JOIN DONDE: "almacen.id"="usuariosAlmacen.idAlmacen")
        $almacenesDeUsuario = UsuariosAlmacen::where('idUsuario', $idUsuario)
                                ->join('almacen', 'usuariosAlmacen.idAlmacen', '=', 'almacen.id')
                                ->select('almacen.nombreAlmacen', 'almacen.descripcion', 
                                         'usuariosAlmacen.tipoDeAcceso', 'usuariosAlmacen.idAlmacen',
                                         'usuariosAlmacen.idUsuario', 'usuariosAlmacen.id')
                                ->get();
        
        return view('/verAlmacenes')->with('almacenes', $almacenesDeUsuario)->with('idUsuario', $idUsuario);

        
        //NOTA: SUBCONSULTAS ANIDADAS A BASE DE DATOS USANDO MODELOS CON LARAVEL
        // $users = User::where(function ($query) {
        //     $query->select('type')
        //         ->from('membership')
        //         ->whereColumn('user_id', 'users.id')
        //         ->orderByDesc('start_date')
        //         ->limit(1);
        // }, 'Pro')->get();
        
        //NOTA: CONSULTA A BASE DE DATOS (SENTENCIA SQL PARCIAL) CON LARAVEL
        // $users = DB::table('users')
        //              ->select(DB::raw('count(*) as user_count, status'))
        //              ->where('status', '<>', 1)
        //              ->groupBy('status')
        //              ->get();

        // $puntosRecoleccion = DB::select(
        //     'SELECT * 
        //      FROM detallesRecolector d, recolectores r, puntosDeReciclaje p
        //      WHERE d.idPuntoReciclaje = p.id AND d.idRecolector = r.id 
        //      AND r.id = ?', [$this->id]);
        
        // dd($puntosRecoleccion);
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
        //Guardar y crear al propietario asociado al almacen creado
        if ($Almacen->save()){
            $usuarioAlmacen = new UsuariosAlmacen();
            $usuarioAlmacen->idUsuario = $request->idUsuario; //Propietario
            $usuarioAlmacen->idAlmacen = $Almacen->id;
            $usuarioAlmacen->tipoDeAcceso = "propietario";
            if($usuarioAlmacen->save()){
                $redirectTo = "/misAlmacenes"."/".$request->idUsuario."/".$usuarioAlmacen->id."/almacen/".$Almacen->id;
                return redirect($redirectTo);
            }
        } 
        $mensaje = "No se ha podido completar la petición, intente más tarde.";
        return view("/crearAlmacen")->with('mensaje', $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show($idUsuario, $idUsuarioAlmacen, $idAlmacen){
        //Buscamos la informacion de almacen junto con los permisos del usuario (de 'usuariosAlmacen')
        // donde los datos de consulta coincidan.
        $datosAlmacen = Almacen::join('usuariosAlmacen', 'usuariosAlmacen.idAlmacen', '=', 'almacen.id')
                    ->where('almacen.id', $idAlmacen)
                    ->where('usuariosAlmacen.id', $idUsuarioAlmacen)
                    ->where('usuariosAlmacen.idUsuario', $idUsuario)
                    ->get()->first();
        
        //Obten la lista de invitados al almacen, usuarios y os ingredientes siempre que la consulta 
        //del acceso sea valida.
        $usuariosDeAlmacen = $invitacionesEnviadas = $ingredientesDelAlmacen = null;
        if (is_null($datosAlmacen)){
            $usuariosDeAlmacen = (new UsuariosAlmacen)->usuariosDeUnAlmacen($idAlmacen);
            $invitacionesEnviadas = (new InvitacionesAlmacenController())->indexParaAlmacen($idAlmacen);
            $ingredientesDelAlmacen = (new IngredientesAlmacen())->ingredientesDeAlmacen($idAlmacen);
        }

        //Obten la lista de invitados al almacen siempre que la consulta sea valida
        return view('almacen')
                ->with('datosAlmacen', $datosAlmacen)
                ->with('idUsuario', $idUsuario)
                ->with('usuariosDeAlmacen', $usuariosDeAlmacen)
                ->with('invitacionesEnviadas',$invitacionesEnviadas)
                ->with('ingredientesDelAlmacen', $ingredientesDelAlmacen);
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
