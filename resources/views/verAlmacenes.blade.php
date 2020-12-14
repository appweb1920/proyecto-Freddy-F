@extends('layouts.baseOp2')

@section('content')

@auth
@if (Auth::user()->id == $idUsuario)
<div class="container">
    <div class="row justify-content-center">
        <h1>Mis almacenes disponibles</h1>
    </div>
    <div class="row d-flex flex-wrap">
        @foreach($almacenes as $almacen)
        <div class="card mx-auto my-auto col-12 col-md-6 col-xl-4">
            <div class="card-body">
                <h5 class="card-title">{{$almacen->nombreAlmacen}}</h5>
                <p class="card-text font-weight-light text-truncate">{{$almacen->descripcion}}</p>
                <div class="card-text">
                    <p class="text-capitalize float-left mt-2 mr-auto font-italic text-secondary" >{{$almacen->tipoDeAcceso}}</p>
                    <a href="/misAlmacenes/{{Auth::user()->id}}/{{$almacen->id}}/almacen/{{$almacen->idAlmacen}}" class="btn btn-primary float-right">Acceder al almacén</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

@endauth

</div>

@endsection