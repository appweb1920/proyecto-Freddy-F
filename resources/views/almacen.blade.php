@extends('layouts.baseOp2')

@section('content')

@if (Auth::user()->id == $idUsuario && !is_null($datosAlmacen) )
<div class="container">
    <div class="row justify-content-center">
        <h1>{{ $datosAlmacen->nombreAlmacen }}</h1>
    </div>
    <div class="row justify-content-center">
        <p class="col-12 col-lg-10 text-center font-weight-light">{{ $datosAlmacen->descripcion }}</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Selectores de Secciones -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-colorPrimario active" id="ingredientes-tab" data-toggle="tab" href="#ingredientes" role="tab" aria-controls="ingredientes" aria-selected="@if(Session::has('verInvitaciones')) false @else true @endif">Inventario de ingredientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-colorPrimario" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Usuarios</a>
                </li>
                @if( $datosAlmacen->tipoDeAcceso == "propietario")
                <!-- Opciones para el propietario -->
                <li class="nav-item ml-auto">  <!-- Espaciado para la izq. -->
                    <a class="nav-link text-colorPrimario" id="invitaciones-tab" data-toggle="tab" href="#invitaciones" role="tab" aria-controls="invitaciones" aria-selected="@if(Session::has('verInvitaciones')) true @else false @endif">Invitaciones enviadas</a>
                </li>
                @endif
            </ul>
            <!-- Secciones -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if(!Session::has('verInvitaciones')) show active @endif" id="ingredientes" role="tabpanel" aria-labelledby="ingredientes-tab">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero dolores quasi distinctio veritatis rerum aperiam, dolore fugiat pariatur porro ratione ipsa cupiditate excepturi delectus eveniet veniam debitis laborum non tempore!
                    </p>
                </div>
                <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla facere maxime ipsa omnis quas rem a neque. Omnis debitis sed ullam. Hic dolorem odio autem nesciunt laudantium provident sed amet.
                        Saepe voluptate iure fugiat cum nostrum, accusamus harum accusantium voluptas voluptates aliquam sit optio dolorem impedit architecto molestias sunt sint adipisci id doloremque in vero fuga. Labore iusto maiores odio?
                        Ratione magni nisi quo omnis amet explicabo laboriosam aliquid deserunt tempore asperiores doloremque nesciunt similique natus fugiat dolor dolores autem hic, distinctio ipsam est. Numquam ipsum repellendus nobis animi minima!
                    </p>
                </div>
                @if( $datosAlmacen->tipoDeAcceso == "propietario")
                <!-- Opciones para el propietario -->
                <div class="tab-pane fade @if(Session::has('verInvitaciones')) show active @endif" id="invitaciones" role="tabpanel" aria-labelledby="invitaciones-tab">
                    <div class="d-flex mx-3 my-3">
                        <a href="/misAlmacenes/{{Auth::user()->id}}/{{$datosAlmacen->id}}/almacen/{{$datosAlmacen->idAlmacen}}/invitarUsuario" 
                            class="btn btn-primary">Invitar usuario</a>
                    </div>
                    <div class="container">
                        @unless( count($invitacionesEnviadas))
                            <p class="text-center text-secondary ">No hay invitaciones enviadas</p>
                        @else
                        <p class="text-center text-secondary ">Las invitaciones enviadas vencen a los 7 días sin respuesta</p>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Email de usuario</th>
                                    <th scope="col">Tipo de acceso</th>
                                    <th scope="col">Invitado por</th>
                                    <th scope="col">Fecha de envío</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @for( $i=0; $i < count($invitacionesEnviadas); $i++ )
                                <tr>
                                    <th scope="row">{{$i+1}}</th>
                                    <td>{{$invitacionesEnviadas[$i]->emailUsuarioInvitado}}</td>
                                    <td class="text-capitalize">{{$invitacionesEnviadas[$i]->tipoDeAcceso}}</td>
                                    <td>{{$invitacionesEnviadas[$i]->remitente}}</td>
                                    <td>{{date_format($invitacionesEnviadas[$i]->created_at, 'd/m/Y')}}</td>
                                    <td class="text-capitalize">{{$invitacionesEnviadas[$i]->estadoInvitacion}}</td>
                                    <td>
                                        
                                            @if($invitacionesEnviadas[$i]->estadoInvitacion == 'pendiente')
                                            <form action="/invitacionesRecibidas/respuestaInvitacion" method="post">
                                                @csrf
                                                <input type="hidden" name="idInvitacion" value="{{$invitacionesEnviadas[$i]->id}}">
                                                <button class="btn btn-link m-1 p-0" type="submit" name="respuestaInvitacion" value="cancelada">Cancelar</button>
                                            </form>
                                            @endif
                                            <form action="/invitacionesRecibidas/eliminaInvitacion" method="post">
                                                @csrf
                                                <input type="hidden" name="idInvitacion" value="{{$invitacionesEnviadas[$i]->id}}">
                                                <button class="btn btn-link m-1 p-0" type="submit" value="{{$invitacionesEnviadas[$i]->estadoInvitacion}}">Eliminar</button>
                                            </form>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        @endunless
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion o la petición no tiene resultados -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

</div>

@endsection