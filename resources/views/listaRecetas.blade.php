@extends('layouts.baseOp2')

@section('content')

@if (Auth::user()->id && !is_null($recetas) )
<div class="container">
    <div class="row justify-content-center">
        <h1>Recetas disponibles</h1>
    </div>
    <div class="row d-flex">
        <d class="col-12 justify-content-center">
            @if (!count($recetas))
            <p class="text-center text-secondary">Actualmente no existen recetas disponibles en el registro.</p>
            @else
            <p class="text-center text-secondary mt-5">Accede a cada receta para ver más detalles.</p>
            @endif
        </d>
        @foreach($recetas as $key => $receta)
        <div class="card my-auto p-n1 col-12 col-md-6 col-xl-4">
            <div class="card-body">
                <h5 class="card-title">{{$receta->nombreReceta}}</h5>
                <p class="card-text font-weight-light text-truncate">{{$receta->categoria}}</p>
                <div class="card-text">
                    <a href="/listaDeRecetas/verReceta/{{$receta->id}}" class="btn btn-primary float-right">Ver receta</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion o la petición no tiene resultados -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif

</div>

@endsection