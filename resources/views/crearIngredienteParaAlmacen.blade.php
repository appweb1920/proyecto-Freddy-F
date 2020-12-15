@extends('layouts.baseOp2')

@section('content')

@if ( Auth::user()->id == $idUsuario)
<div class="container">
    <div class="row justify-content-center">
        <h1>Nuevo ingrediente para el almacén</h1>
    </div>

    <div class="row justify-content-center">
        <form action="/crearIngredienteEnAlmacen" class="needs-validation col-lg-10 " method="POST" novalidate>
            @csrf
            <input type="hidden" name="idUsuarioPropietario" value="{{ Auth::user()->id }}" required>
            <input type="hidden" name="idAlmacen" value="{{ $idAlmacen }}" required>
            <input type="hidden" name="idUsuarioAlmacen" value="{{ $idUsuarioAlmacen }}" required>

            <div class="form-row">
                @if(count($ingredientesDelAlmacen)) 
                <div class="col-lg-7 mb-3">
                    <label for="validationDefault01">Basado en ingrediente existente: </label>
                    <input type="checkbox" class="form-control" name="usarIngredienteExistente" id="validationDefault01" required>
                </div>
                <div class="col-lg-5 mb-3">
                    <label for="validationDefault02"> Seleccione ingrediente existente:</label>
                    <select class="custom-select" name="idIngrediente" id="validationDefault02" >
                        @foreach ($ingredientesDelAlmacen as $key => $ingredienteRegistrado)
                        <option value="{{$ingredienteRegistrado->idIngrediente}}">{{$ingredienteRegistrado->nombreIngrediente}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
            <!-- REQUIERE MEJORES VALIDACIONES CON JS PARA VALIDAR UNA OPCION O LA OTRA-->
            <div class="form-row">
                <p class="col-11 font-weight-bold text-center">Campos generales para el ingrediente</p>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault04">Nombre del Ingrediente:</label>
                    <input type="text" class="form-control" name="nombreIngrediente" id="validationDefault04" 
                            placeholder="El nombre geneal para el ingrediente de este tipo" @if(!count($ingredientesDelAlmacen)) required @endif>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault05">Categoria del Ingrediente:</label>
                    <input type="text" class="form-control" name="categoriaIngrediente" id="validationDefault05" 
                            placeholder="El nombre geneal para el ingrediente de este tipo" @if(!count($ingredientesDelAlmacen)) required @endif>
                </div>
                <div class="col-lg-6 ccol-md-6 mb-3">
                    <label for="validationDefault06">Medida base del Ingrediente:</label>
                    <select class="custom-select" name="medidaBaseIngrediente" id="validationDefault06" @if(!count($ingredientesDelAlmacen)) required @endif>
                        <option value="masa">Masa (gr, Kg...)</option>
                        <option value="volumen">Volumen (ml, L, taza, gal)</option>
                    </select>
                </div>
            </div>
            
            <!-- CAMPOS OBLIGATORIOS-->
            <div class="form-row">
                <p class="col-11 font-weight-bold text-center">Especificaciones para Manejo en Almacén</p>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault07">Tipo de medicion en Almacen (Seleccion temporalmente limitada)</label>
                    <select class="custom-select" name="medidaBaseIngredienteAlmacen" id="validationDefault07" required>
                        <option value="gr">Gramos</option>
                        <option value="kg">Kilogramos</option>
                        <option value="ml">Mililitros</option>
                        <option value="L">Litros</option>
                        <option value="pz">Piezas o Unidades</option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault08">Factor de conversion a unidad base del ingrediente</label>
                    <input type="number" min="0" class="form-control" name="factorConversionIngredienteAlmacen" id="validationDefault08" 
                            placeholder="El nombre geneal para el ingrediente de este tipo" required>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault09">Cantidad</label>
                    <input type="number" min="0" class="form-control" name="cantidadIngredienteAlmacen" id="validationDefault09" 
                            placeholder="El nombre geneal para el ingrediente de este tipo" required>
                </div>
                <div class="col-lg-6 col-md-6 mb-3">
                    <label for="validationDefault10">Fecha de caducidad (si la tiene) </label>
                    <input type="date" class="form-control" name="fechaCaducidad" id="validationDefault10">
                </div>
            </div>

            @if (Session::has('errorMsg'))
                <div class="alert alert-warning"> {{ Session::get('errorMsg') }} </div>
            @endif

            <div class="form-row justify-content-around">
                <button class="btn btn-primary" type="submit">Enviar invitación</button>
                <a class="btn btn-primary" href="/misAlmacenes/{{Auth::user()->id}}/{{$idUsuarioAlmacen}}/almacen/{{$idAlmacen}}">Cancelar</a>
            </div>
        </form>
    </div>
@else
    <!-- El usuario no tiene acceso a esta ubicacion o la petición no tiene resultados -->
    <div class="row justify-content-center">
        <p class="text-center text-danger ">Acceso denegado</p>
    </div>
@endif
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection