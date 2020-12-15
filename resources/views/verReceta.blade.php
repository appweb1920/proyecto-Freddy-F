@extends('layouts.baseOp2')

@section('content')

@if (Auth::user()->id && !is_null($receta) )
<div class="container">
    <div class="row justify-content-center">
        <h1>{{$receta->nombreReceta}}</h1>
    </div>
    <div class="row d-flex">
        <d class="col-12 justify-content-center">
            <p class="text-center font-weight-bold text-secondary"> {{$receta->categoria}} </p>
            <p class="text-center text-secondary">
                Porciones: {{$receta->numPorciones}} | Tiempo de preparación: {{$receta->tiempoPreparacion}} minutos
            </p>
        </d>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-4">
            <p class="font-weight-bold">Ingredientes:</p>
            @unless ( count($ingredientes) )
            <p class="text-center text-secondary">
                Esta receta no tiene ingredientes registrados puede haber algún error. <br>
            </p>
            @else
            <ul>
                @foreach($ingredientes as $key => $ingrediente)
                <!-- Puede buscarse una forma de hacer fraccione -->
                <li class="text-lowercase">{{$ingrediente->cantidad . ' ' . $ingrediente->tipoDeCantidad . ' de ' . $ingrediente->nombreIngrediente}}</li> 
                
                @endforeach
            </ul>
            @endunless
        </div>
        
        <div class="col-md-10 col-lg-8">
            <p class="font-weight-bold">Preparación:</p>
            @unless ( count($pasosReceta) )
            <p class="text-center text-secondary text-uppercase">
                Esta receta no tiene una preparación registrada puede haber algún error. <br>
            </p>
            @else
            <ol>
                @foreach($pasosReceta as $key => $paso)
                <li> <p class=""> {{$paso->textoPaso}} </p> </li> 
                @endforeach
            </ol>
            @endunless
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