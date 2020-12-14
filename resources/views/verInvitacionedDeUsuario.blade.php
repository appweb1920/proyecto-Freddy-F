@extends('layouts.baseOp2')

@section('content')

@if (Auth::user()->id == $idUsuario && !is_null($invitaciones) )
<div class="container">
    <div class="row justify-content-center">
        <h1>Mis Invitaciones</h1>
    </div>
    
    <div class="row justify-content-center">
        @unless( count($invitaciones))
            <p class="text-center text-secondary ">Aún no hay invitaciones recibidas</p>
        @else
        <p class="text-center text-secondary ">Las invitaciones vencidas más antiguas no se mostrarán</p>
        <table class="table table-hover col-12 col-lg-10">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nombre del almacén</th>
                    <th scope="col">Invitado por</th>
                    <th scope="col">Tipo de acceso</th>
                    <th scope="col">Fecha de envío</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @for( $i=0; $i < count($invitaciones); $i++ )
                <tr> Se muestran las invitaciones que aún no se han vencido.</tr>
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td class="text-capitalize">{{$invitaciones[$i]->nombreAlmacen}}</td>
                    <td class="text-capitalize">{{$invitaciones[$i]->remitente}}</td>
                    <td class="text-capitalize">{{$invitaciones[$i]->tipoDeAcceso}}</td>
                    <td>{{date_format($invitaciones[$i]->created_at, 'd/m/Y')}}</td>
                    <td>
                    @if($invitaciones[$i]->estadoInvitacion == 'pendiente')
                        <form action="/invitacionesRecibidas/respuestaInvitacion" method="post">
                            @csrf
                            <input type="hidden" name="idInvitacion" value="{{$invitaciones[$i]->id}}">
                            <input type="hidden" name="idUsuario" value="{{Auth::user()->id}}"> <!-- En caso de aceptar -->
                            <button class="btn btn-link m-1 p-0" type="submit" name="respuestaInvitacion" value="aceptada">Aceptar</button>
                            <button class="btn btn-link m-1 p-0" type="submit" name="respuestaInvitacion" value="rechazada">Rechazar</button>
                        </form>
                    @else ($invitaciones[$i]->estadoInvitacion == 'aceptada' || $invitaciones[$i]->estadoInvitacion == 'vencida')
                        <p class="font-italic text-secondary text-capitalize"> {{$invitaciones[$i]->estadoInvitacion}}</p>
                    @endif
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
        @endunless
    </div>


@else
    <!-- El usuario no tiene acceso a esta ubicacion o la petición no tiene resultados -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

</div>

@endsection